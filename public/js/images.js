window.onload = () => {

    // gestion des boutons 'supprimer'

    let links = document.querySelectorAll("[data-delete]");

    //on boucle sur links

    for (const link of links) {
        //on ecoute le clic
        link.addEventListener("click",function(e){
            //On desactive le lien
            
            e.preventDefault(); 

            //confirmation pop up
            if(confirm('Voulez-vous vraiment supprimer cette photo ?')){
                 // On envoie une requête AJAX vers le href du lien avec la methode DELETE 
                 fetch(this.getAttribute("href"),{
                     method : "DELETE",
                     headers: {
                         "X-Requested-With": "XMLHttpRequest",
                         "Content-Type": "application/json"
                     },
                     body: JSON.stringify({'_token': this.dataset.token})
                     
                 }).then(
                     //On recupere la reponse en JSON
                     response => response.json()
                 ).then(data=>{
                    if(data.success)
                        this.parentElement.remove()
                    else
                        alert(data.error)
                 }).catch(e=>alert(e))
            }
        })
    }

}

$citems = document.querySelectorAll("#carouselActive")
console.log($citem)

for (const citem of citems)

 for (const citem of citems){
     citem.addEventListener('click',function(){
        
     })
 }