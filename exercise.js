let candidatures = []
let id = 1;


function ajouterCandidature(nom, age, projet)
{
      let exists = false;

 candidatures.forEach(candidature=>
 {
   if(nom === candidature.nom)
   {
   exists = true;
   }
 })
 if(exists)
 {
   console.log('candidat already exists');
   return;
 }
  candidatures.push({'id' : id, 'nom' : nom, 'age' : age, 'projet' : projet, 'status' : 'inWait'});
  id += 1;
  return;
}


ajouterCandidature('youness', 25, 'test');
ajouterCandidature('amine', 25, 'test');
ajouterCandidature('said', 18, 'test');

console.log(candidatures)





function displayApplications()
{
   if (candidatures.length === 0) {
   console.log('no candidat to display');
   return;
 }

  candidatures.forEach(candidature =>
  {
    console.log(`id: ${candidature.id}`);
    console.log(`name: ${candidature.nom}`);
    console.log(`age: ${candidature.age}`);
    console.log(`project: ${candidature.project}`);
    console.log(`status: ${candidature.status}`);
    console.log(``);
    
  })
}

displayApplications();

function validerCandidature(id)
{
 for (let i = 0; i < candidatures.length; i++) {
 
   if(id === candidatures[i].id)
    {
      candidatures[i].status = 'valide';
      console.log(`status changed for candidate ${candidatures[i].nom}`)
      return;
    }
   
 }
    console.log('candidat doesnt exists');

}


function rejectCandidature(id)
{
 
 for (let i = 0; i < candidatures.length; i++) {
 
   if(id === candidatures[i].id)
    {
      candidatures[i].status = 'rejected';
      console.log(`status changed for candidate ${candidatures[i].nom}`)
      return;
    }
   
 }
 
    
    console.log('candidat doesnt exists');

}


function rechercherCandidat(name) {
 for (let i = 0; i < candidatures.length; i++) {
   if (name === candidatures[i].nom) { 
     console.log('Candidat found');
     console.log('');
     console.log(`id: ${candidatures[i].id}`);
     console.log(`name: ${candidatures[i].nom}`);
     console.log(`age: ${candidatures[i].age}`);
     console.log(`project: ${candidatures[i].projet}`);
     console.log(`status: ${candidatures[i].status}`);
     return; 
   }
 }
 console.log('Candidat not found');
}

function filterByStatut(status)
{
  for (let i = 0; i < candidatures.length; i++) {
   if (status === candidatures[i].status) { 
     console.log(`id: ${candidatures[i].id}`);
     console.log(`name: ${candidatures[i].nom}`);
     console.log(`age: ${candidatures[i].age}`);
     console.log(`project: ${candidatures[i].projet}`);
     console.log(`status: ${candidatures[i].status}`);
     console.log('');

   }
 }
}

filterByStatut('enAttent')


function statistiques()
{
 let totalCandidats = candidatures.length;
 let valide = 0;
 let rejected = 0;
 let inWait = 0;
 for (let i = 0; i < candidatures.length; i++) {
   
   if(candidatures[i].status === 'valide')
   {
     valide++;
   }
   else if(candidatures[i].status === 'rejected')
   {
     rejected++;
   }
   else if(candidatures[i].status === 'inWait')
   {
     inWait++;
   }
   
   
   
 }
 console.log(`number of candidats ${totalCandidats}`);
 console.log(`number of rejected candidats ${rejected}`);
 console.log(`number of valide ${valide}`);
 console.log(`number of inWait ${inWait}`);

}

validerCandidature(3);
console.log(statistiques());



