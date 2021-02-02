$('.fa-heart').click(function(){
    let i = 0;
//
    if($(".heart").find(".far").length){
        i++
        $(".heart").find(".far").addClass("fas").removeClass("far")
    }


    else if($(".heart").find(".fas").length){
        i = 0
        $(".heart").find(".fas").addClass("far").removeClass("fas")
    }
    $('.NbLikes').text('Likes : ' + i )
});
//____________________________AFFICHAGE DE L'IMAGE QUE l'ON VEUT SOUMETTRE____________________________________________________

// On va corriger l'affichage du label pour l'upload des images
$('[type="file"]').on('change', function () {
   // let label = $(this).val().split('\\').pop(); // C:\fakepath\5.png devient 5.png
    // On ajoute le label dans l'élément suivant le input
  //  $(this).next().text(label);

    // On va afficher un aperçu de l'image avant l'upload
    let reader = new FileReader();
    // On doit écouter un événement pour faire quelque chose avec cette image
    reader.addEventListener('load', function (file) {
        // Cleaner les anciennes images
        $('.custom-file img').remove();
        // Je réupère l'image au format base64
        let base64 = file.target.result;
        // Je crée une balise img en JS
        let img = $('<img class="img-fluid mt-5" width="250" />');
        // Je mets le base64 dans le src de l'img
        img.attr('src', base64);
        // Afficher l'image dans la div .custom-file
        $('.custom-file').prepend(img);
    });

    // Le JS va charger l'image en mémoire
    reader.readAsDataURL(this.files[0]);
}); // Fin du on('change')

//_____________________REDUIRE LE CHAMP DE TEXTE DES CARD___________________
let currentText = $(".LimitDescription").text();
if(currentText.length > 100) {
    $("p.LimitDescription").html(currentText.substr(0, 100));
}

