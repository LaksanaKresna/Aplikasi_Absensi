const video = document.getElementById('videoInput')
const base_url=`http://localhost:8000`;
Promise.all([
    faceapi.nets.faceRecognitionNet.loadFromUri('/plugin/faceapi/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('/plugin/faceapi/models'),
    faceapi.nets.ssdMobilenetv1.loadFromUri('/plugin/faceapi/models') //heavier/accurate version of tiny face detector
]).then(start)


function start() {
    document.body.append('Initalizing..')
    
    navigator.mediaDevices.getUserMedia({
        video: {},
        audio : false
    }).then((steam) => {video.srcObject = steam});
    
    //video.src = '../videos/speech.mp4'
    console.log('video added')
    recognizeFaces()
}



async function recognizeFaces() {

    const labeledDescriptors = await loadLabeledImages()
    document.body.append(' Ready..')
    // console.log(labeledDescriptors)
    const faceMatcher = new faceapi.FaceMatcher(labeledDescriptors, 0.5)


    video.addEventListener('play', async () => {
        console.log('Playing')
        const canvas = faceapi.createCanvasFromMedia(video)
        document.body.append(canvas)

        const displaySize = { width: video.width, height: video.height }
        faceapi.matchDimensions(canvas, displaySize)
        let json;
        await new Promise(done => $.getJSON('/plugin/faceapi/list.json', async function (data) {
            json = data;
            done();
        }));
        console.log(json)
        setInterval(async () => {
            const detections = await faceapi.detectAllFaces(video).withFaceLandmarks().withFaceDescriptors()

            const resizedDetections = faceapi.resizeResults(detections, displaySize)

            canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)

            const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
            faceapi.draw.drawDetections(canvas, resizedDetections);
            
            results.forEach( (result, i) => {
                console.log(result)
                if(result._label!=='unknown'){
                        let name = `Name : ${json[result._label]}, ID : ${result._label}`;
                        const box = resizedDetections[i].detection.box
                        const drawBox = new faceapi.draw.DrawBox(box, { label: name.toString() })
                        drawBox.draw(canvas)
                        // console.log(name)
                        if ($("#detect").is(':checked')) {
                        const answer = window.confirm(`Someone detected, are you ${name} ? \nIf yes, press ok.`);
                        if (answer) {
                        let newTab = window.open();
                        newTab.location.href = `${base_url}/attandance/create?label=${result._label}`;
                        }else{
                            $('#detect').prop('checked', false);
                        }
                    }
                }
                
            })
        }, 100)


        
    })
}


function loadLabeledImages() {
    // const labels = ['fauzi','acha','nurul'] // for WebCam
    let labels = []; 

    $.ajax({
        url:'/getFace',
        method:'GET',
        dataType: 'json',
        async:false,
        success:  function(data) {
            $.each(data, function (key, value) {
                        labels.push(value);
                        console.log(value)
                    });
            }
    });

    return Promise.all(
            labels.map(async (label)=>{
                const descriptions = []
                for(let i=1; i<=2; i++) {
                    const img = await faceapi.fetchImage(`${base_url}/storage/faces/${label}/${i}.png`+"?" + Math.random())
                    const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
                    // console.log(label + i + JSON.stringify(detections))
                    descriptions.push(detections.descriptor)
                }
                // document.body.append(label+' Faces Loaded | ')
                document.body.append('.')
                
                return new faceapi.LabeledFaceDescriptors(label, descriptions)
            })
            
        )
}