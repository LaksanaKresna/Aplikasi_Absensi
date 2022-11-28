let video = document.getElementById("videoInput");
const base_url=`http://localhost:8000`;
let displaySize;


const startSteam = () => {
    console.log("----- START STEAM ------");
    document.body.append('Initalizing..')
    navigator.mediaDevices.getUserMedia({
        video: {},
        audio : false
    }).then((steam) => {video.srcObject = steam});
    detect()
}

// console.log(faceapi.nets);

console.log("----- START LOAD MODEL ------");
Promise.all([
    faceapi.nets.ssdMobilenetv1.loadFromUri('/plugin/faceapi/models'),
    faceapi.nets.faceLandmark68Net.loadFromUri('/plugin/faceapi/models'),
    faceapi.nets.faceRecognitionNet.loadFromUri('/plugin/faceapi/models')
]).then(startSteam);


async function detect() {
    const labeledFaceDescriptors = await loadLabeledImages()
    document.body.append(' Ready..')
    video.addEventListener('play', async () => {
        console.log('Playing')
        const canvas = faceapi.createCanvasFromMedia(video)
        document.body.append(canvas)

        const displaySize = { width: video.width, height: video.height }
        faceapi.matchDimensions(canvas, displaySize)
        const faceMatcher = new faceapi.FaceMatcher(labeledFaceDescriptors, 0.4)
        let json;
        await new Promise(done => $.getJSON('/plugin/faceapi/list.json', async function (data) {
            json = data;
            done();
        }));
        console.log(json)
        setInterval(async () => {
        const detections = await faceapi.detectAllFaces(video)
                                            .withFaceLandmarks()
                                            .withFaceDescriptors();
            //console.log(detections);
            
            canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height)
            const resizedDetections = faceapi.resizeResults(detections, displaySize)
            const results = resizedDetections.map(d => faceMatcher.findBestMatch(d.descriptor))
            console.log(results);
            faceapi.draw.drawDetections(canvas, resizedDetections);
            
        
            results.forEach((result, i) => {
            // console.log(result._label);
            let name;
            const box = resizedDetections[i].detection.box
            if(result._label!=='unknown'){
                let num=parseFloat(result._distance).toFixed(2);
                name = `Name : ${json[result._label]}, ID : ${result._label} (${num})`;
            }else{
                name=result;
            }
            
            const drawBox = new faceapi.draw.DrawBox(box, { label: name.toString() })
            drawBox.draw(canvas)
            if(result._label!=='unknown'){
                
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
    labels.map(async label => {
      const descriptions = []
      for (let i = 1; i <= 2; i++) {
        const img = await faceapi.fetchImage(`${base_url}/storage/faces/${label}/${i}.png`+"?" + Math.random())
        const detections = await faceapi.detectSingleFace(img).withFaceLandmarks().withFaceDescriptor()
        descriptions.push(detections.descriptor)
        
      }
    document.body.append('.')
      return new faceapi.LabeledFaceDescriptors(label, descriptions)
    })
  )
}

