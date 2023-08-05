
// Instanciation de VUE JS

const App = {
  //Propriétés de notre application
  data() {
    return {
        user: {
            nom: "",
            prenom: "",
            agePro: "",
            },
        voiture: {
            pf: "",
            ageVoit: "",
            marque: "",
            modele: "",
            },
        cout: "",
    };
  },

  //Methods: Permet de créer nos fonctions
  methods: {
    //Permet d'avoir la simulation après avoir entrer l'age du propriétaire et le modele de la voiture
    checkSimulation() {
      const user = this.user;
      const voiture = this.voiture;
          if (!InputIsEmpty(user) || !InputIsEmpty(voiture)) {
              data = [user,voiture]
            
              fetch('https://127.0.0.1:8000/api/checksimulation', {
                  method: "POST",
                  headers: {
                      "Content-Type": "application/json",
                      "Accept": "application/json"
                  },
                  body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(response => this.cout = response)
            .catch(error => alert("Erreur : " + error));
          //Swal.fire("Merci de votre confiance.", "", "info");
      } else {
        Swal.fire("Remplir tous les champs!", "", "error");
      }
      },
      
    //Permet d'ajouter la simulation en base de données
    addSimulation() {
      const user = this.user;
      const voiture = this.voiture;
      const cout = this.cout;
          if (!InputIsEmpty(user) || !InputIsEmpty(voiture)  || !InputIsEmpty(cout)) {
              data = [user,voiture,cout]
            
              fetch('https://127.0.0.1:8000/api/addsimulation', {
                  method: "POST",
                  headers: {
                      "Content-Type": "application/json",
                      "Accept": "application/json"
                  },
                  body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(response => Swal.fire("Merci de votre confiance.", "", "info"))
            .catch(error => alert("Erreur : " + error));
              this.user.nom = "";
                  this.user.prenom = "";
                  this.user.agePro = "";
                  this.voiture.ageVoit = "";
                  this.voiture.marque = "";
                  this.voiture.modele = "";
                  this.voiture.pf = "";
                  this.cout = "";
      } else {
        Swal.fire("Remplir tous les champs!", "", "error");
      }
    },

  },
};

//Mount: Permet de lancer notre application
Vue.createApp(App).mount("#app");
