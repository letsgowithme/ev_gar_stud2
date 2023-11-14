// window.onload = () => {
//     const FiltersForm = document.querySelector("#filters");
    
//     // on boucle sur les input
//     document.querySelectorAll("#filters input").forEach(input => {
//       input.addEventListener("change", () =>{

//         // on intercepte les clics
//         // on recup les données de form
//         const Form = new FormData(FiltersForm);
//         // on fait queryString
//         const Params = new URLSearchParams();

//         Form.forEach((value, key) =>{
//          Params.append(key, value);
        
//         });  

//         // on recup l'url active
//         const Url = new Url(window.location.href);
//       // console.log(Url);
//         //on lance le requete Ajax

//        fetch(Url.pathname + "?" + Params.toString() + "&ajax=1",{
//         headers: {
//           "X-Requested-With": "XMLHttpRequest"
//         }
//        }).then(response => {
//        response = response.json()
//        }).then(data =>{
        
//        }

//        ).catch(err => alert(err))
//       });
//     });




// }