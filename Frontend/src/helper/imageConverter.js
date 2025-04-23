
// let img = document.getElementById('tst');

export function getBase64Img(file){
    
   return new Promise((resolve,reject)=>{

     const reader = new FileReader();
     reader.readAsDataURL(file);

     reader.addEventListener('load',(event)=>{
        resolve(reader.result);
     });
     reader.addEventListener('error',(e)=>{
        reject("Error happeded");
     })

   }); 
}

// img.addEventListener('change',async(e)=>{
//     const file = e.target.files[0];   
    
//     try{
//        let image = await getBase64Img(file)
//        let resizedImg = await resizeImage(image);
//        console.log(resizedImg);
//        run(resizedImg);
//     }catch(er){
//         console.log(er);
//     }
// });

// function run(str){

//     let image = new Image();
//     image.src = str
    
//     let body = document.querySelector('body');
    
//     body.appendChild(image);
// }

export function calc_image_size(image) {
  let y = 1;
  if (image.endsWith('==')) {
      y = 2
  }
  const x_size = (image.length * (3 / 4)) - y
  return Math.round(x_size / 1024)
}