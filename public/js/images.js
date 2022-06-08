window.onload = () => {

    // gestion des boutons 'supprimer'

    let links = document.querySelectorAll("[data-delete]");

    //on boucle sur links

    for (const link of links) {
        //on ecoute le clic
        link.addEventListener("click", function(event){
            //On desactive le lien
            
            event.preventDefault(); 

            //confirmation pop up
            if(confirm('Voulez-vous vraiment supprimer cette photo ?')){
                console.log(JSON.stringify({"_token": this.dataset.token}))
                 // On envoie une requête AJAX vers le href du lien avec la methode DELETE 
                 fetch(this.getAttribute("href"),{
                     method : "DELETE",
                     headers: {
                         "X-Requested-With": "XMLHttpRequest",
                         "Content-Type": "application/json"
                     },

                    //  body: {"_token": "511881e26c92d9ea.r6zfmulDfsCSiqXSWN5wyUZ993XHTEO37wSiptkry_Y.5uaM6MQIJKGl__OXHJchgxkxhxK9BBGOrjTX95tu-KDqzbHuhwAWn-HIkQ"}
                     body: JSON.stringify({"_token": this.dataset.token})
                 }).then(
                     //On recupere la reponse en JSON
                     response =>  response.json(),
                    

                 ).then(data=>{
                     console.log(data);
                    if(data.success)
                        this.parentElement.remove()
                    else
                        alert(data.error)
                 }).catch(e=>alert(e))
            }
        })
    }

}

