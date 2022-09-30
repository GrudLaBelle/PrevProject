// add class attribute to nav bar for mobile view
function showMenu(){
	document.querySelector('.navigation').classList.toggle('active');
	document.querySelector('.menu').classList.toggle('hide');
	document.querySelector('.close').classList.toggle('show');
}


// setMobileTable('table') responsive
// get th value and set as label attr for each td
// see CSS ::before for usage
function setMobileTable(selector){
    if (window.innerWidth > 768) return false;
    const tableEl = document.querySelector(selector);
    if (tableEl == null) return false;
    const thEls = tableEl.querySelectorAll('thead th');
    const tdLabels = Array.from(thEls).map(el => el.innerText);
    tableEl.querySelectorAll('tbody tr').forEach( tr => {
        Array.from(tr.children).forEach( 
            (td, ndx) =>  td.setAttribute('label', tdLabels[ndx]==undefined?"":tdLabels[ndx])
        );
    });
}


document.addEventListener( 'DOMContentLoaded', function(){

    /**
    * Validator for login and sign up forms
    * @author                   Antoine BARRE
    * @param    {Event} event   Event return on submit in form
    * @return   {bool}          Return true or false depending on whether the regex validation is successfull or not
    */
    let connexionform = document.querySelector('#session');
    if(connexionform) {
        connexionform.addEventListener('submit', function(event){
            
            const email = connexionform["email"];
            const password = connexionform["password"];

            // Mail validation
            if (email.value == "")
                {
                    event.preventDefault();
                    alert("Veuillez saisir une adresse mail.");
                    email.focus();
                    return false;
                }

            const regexMail = /^.+@.+\..+$/;
            if(email.value.match(regexMail)===null)
                {
                    event.preventDefault();
                    alert("Veuillez saisir une adresse mail valide.");
                    email.focus();
                    return false;
                }

            // Password validation
            if (password.value == "")
                {
                    event.preventDefault();
                    alert("Veuillez saisir un mot de passe.");
                    password.focus();
                    return false;
                }
            
            const passwordRegex =  /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;
            if(password.value.match(passwordRegex)===null)
                { 
                    event.preventDefault();
                    alert('Mot de passe invalide.');
                    password.focus();
                    return false;
                }
            return true;
        });
    }
      
    /**
    * Validator for enterprise form
    * @author                       Antoine BARRE
    * @param    {Event}  event      Event return on submit in form
    * @return   {bool}              Return true or false depending on whether the regex validation is successfull or not
    */
    let entrepriseForm = document.querySelector('#user_enterprise_data');
    if(entrepriseForm) {
        entrepriseForm.addEventListener('submit', function(event, obs){

            // Regex validation on multiple fields
            const regexName = /^([a-z]|\s)+$/;
            const regexNumber = /^[0-9]{0,}$/;
            
            // Enterprise field
            const enterpriseName = entrepriseForm["enterprise_name"];
            if(enterpriseName.value.match(regexName)===null) 
                {
                    event.preventDefault();
                    enterpriseName.focus();
                    alert('Saisir le nom de l\'entreprise en minuscule sans accent ni ponctuation.');
                    return false;
                }
            
            // Siret field
            const siret = entrepriseForm["siret"];
            const regexSiret =  /^\d{14}$/;
            if(siret.value.match(regexSiret)===null) 
                { 
                    event.preventDefault();
                    siret.focus();
                    alert('Saisir un siret valide (14 chiffres).');
                    return false;
                }
            
            // APE code field
            const apeCode = entrepriseForm["ape_code"];
            const regexApeCode =  /^([0-9]{4})([A-Z]{1})$/;
            if(apeCode.value.match(regexApeCode)===null) 
                { 
                    event.preventDefault();
                    apeCode.focus();
                    alert('Saisir un code APE valide: 4 chiffres suivis d\'une lettre en majuscule.');
                    return false;
                }
                
            // APE name field
            const apeName = entrepriseForm["ape_name"];
            if(apeName.value.match(regexName)===null) 
                { 
                    event.preventDefault();
                    apeName.focus();
                    alert('Saisir le nom du code APE en minuscule (que des lettres).');
                    return false;
                }
                
            // Worker number
            const workersNumber = entrepriseForm["workers_number"];
            if(workersNumber.value.match(regexNumber)===null) 
                { 
                    event.preventDefault();
                    workersNumber.focus();
                    alert('Saisir un nombre valide.');
                    return false;
                }
                
            // Accident number field
            const accidentsNumber = entrepriseForm["accidents_number"];
            if(accidentsNumber.value.match(regexNumber)===null) 
                { 
                    event.preventDefault();
                    accidentsNumber.focus();
                    alert('Saisir un nombre valide.');
                    return false;
                }
            
            // Index of frequency field
            const indexOfFrequency = entrepriseForm["index_of_frequency"];
            const regexIndexOfFrequency = /^[+-]?\d+(\.\d+)?$/;
            if(indexOfFrequency.value.match(regexIndexOfFrequency)===null) 
                { 
                    event.preventDefault();
                    indexOfFrequency.focus();
                    alert('Saisir un indice de fréquence valide (chiffres séparés par un ".") .');
                    return false;
                }
            
            // Year field
            const year = entrepriseForm["year"];
            const regexYear = /^\d{4}$/;
            if(year.value.match(regexYear)===null) 
                { 
                    event.preventDefault();
                    year.focus();
                    alert('Saisir une année valide (4 chiffres).');
                    return false;
                }
                
            return true; // if all regex validation are successfull, return true
        })
    }
});