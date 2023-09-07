function validerFormulaire() {
  var nom = document.forms["monpremierFormulaire"]["nom"].value;
  var email = document.forms["monpremierFormulaire"]["email"].value;
  var mdp = document.forms["monpremierFormulaire"]["mdp"].value;
  var verifmdp = document.forms["monpremierFormulaire"]["verifmdp"].value;
  var adresse = document.forms["monpremierFormulaire"]["adresse"].value;

  // Vérification du nom
  if (nom == "") {
      afficherMessageErreur("Le champ nom est obligatoire.");
      return false;
  }

  // Vérification de l'email
  if (email == "") {
      afficherMessageErreur("Le champ email est obligatoire.");
      return false;
  } else if (!validerEmail(email)) {
      afficherMessageErreur("Veuillez entrer une adresse email valide.");
      return false;
  }

  // Vérification du mot de passe
  if (mdp == "") {
      afficherMessageErreur("Le champ mot de passe est obligatoire.");
      return false;
  } else if (mdp.length < 8) {
      afficherMessageErreur("Le mot de passe doit contenir au moins 8 caractères.");
      return false;
  }

  // Vérification de la confirmation du mot de passe
  if (verifmdp == "") {
      afficherMessageErreur("Veuillez confirmer votre mot de passe.");
      return false;
  } else if (verifmdp !== mdp) {
      afficherMessageErreur("Les mots de passe ne correspondent pas.");
      return false;
  }

  // Vérification de l'adresse
  if (adresse == "") {
      afficherMessageErreur("Le champ adresse est obligatoire.");
      return false;
  }

  // Si toutes les validations passent, le formulaire est soumis
  return true;
}

function afficherMessageErreur(message) {
  var messageElement = document.createElement("p");
  messageElement.style.color = "red";
  messageElement.innerHTML = message;

  var formulaire = document.getElementById("formulaire");
  formulaire.appendChild(messageElement);
}

function validerEmail(email) {
  // Expression régulière pour la validation de l'email
  var re = /\S+@\S+\.\S+/;
  return re.test(email);
}

const form = document.querySelector('form[name="mondeuxiemeform"]'); // select the form element

form.addEventListener('submit', (event) => {
  event.preventDefault(); // prevent the form from submitting

  // get the input values
  const emailInput = document.querySelector('#email');
  const passwordInput = document.querySelector('#mdp');

  // check if the inputs are empty
  if (!emailInput.value || !passwordInput.value) {
    alert('Please fill in all the fields');
  } else {
    // submit the form if the inputs are not empty
    form.submit();
  }
});
function validerFormulaire2() {
  var nom = document.getElementById("nom").value;
  var email = document.getElementById("email").value;
  var message = document.getElementById("message").value;

  // Vérification des champs vides
  if (nom === "" || email === "" || message === "") {
      alert("Veuillez remplir tous les champs du formulaire.");
      return false;
  }

  // Affichage du message de confirmation
  var confirmation = document.getElementById("confirmation");
  confirmation.style.display = "block";

  // Empêcher l'envoi du formulaire
  return false;
}


