// ADD //

var addIcon = document.querySelector('.header__add-container');
var addMenu = document.querySelector('.add_card');

addIcon.addEventListener('click', function() {
	addMenu.classList.toggle('hidden');

});


// ADD TAGG //

var addTag = document.querySelector('.tags__add-tag a');
var section = document.querySelector('.contacts__list');

addTag.addEventListener('click', function(e) {
	e.preventDefault();
	var newArticle = document.createElement('article');
	newArticle.className = "contactCard add_submit"
	section.appendChild(newArticle);
	newArticle.innerHTML = '<div class="container-tag"><form action="/tags/add" method="post" accept-charset="utf-8"><div class="tagsCard__main-infos"><input type="text" name="name"></div><div class="tagsCard__explain"><input type="text" placeholder="Saisissez une description..."></div><div class="tagsCard__uses"><p>La couleur du tag sera ajoutée aléatoirement</p></div><div class="tags__submit-tag"><input type="submit" value="Ajouter un tag"></div></form></div>';
});
