<?php
interface Reserve {
    public function reserver(Client $client, DateTime $dateDebut, int $nbJours): Reservation;
}

abstract class Vehicule implements Reserve {
    protected int $id;
    protected string $immatriculation;
    protected string $marque;
    protected string $modele;
    protected float $prixJour;
    protected bool $disponible = true;

    public function __construct(int $id, string $immatriculation, string $marque, string $modele, float $prixJour) {
        $this->id = $id;
        $this->immatriculation = $immatriculation;
        $this->marque = $marque;
        $this->modele = $modele;
        $this->prixJour = $prixJour;
    }

    public function estDisponible(): bool {
        return $this->disponible;
    }

    public function calculerPrix(int $jours): float {
        return $jours * $this->prixJour;
    }

    abstract public function getType(): string;

    public function afficherDetails(): void
    {
        echo "ID: $this->id, $this->marque $this->modele, Prix/Jour: $this->prixJour DH";        
    }


    public function reserver(Client $client, DateTime $dateDebut, int $nbJours): Reservation {
        if (!$this->disponible) {
        throw new Exception("Véhicule non disponible"); //cant return error string, strict typing 
        }
        $reservation = new Reservation($this, $client, $dateDebut, $nbJours);
        $this->disponible = false;
        return $reservation;
    }
    
    public function getImmatriculation()
    {
      return $this->immatriculation;
    }

}









class Car extends Vehicule
{
    private int $nbPortes;
    private string $transmission;

    public function __construct(int $id, string $immatriculation, string $marque, string $modele, float $prixJour, int $nbPortes, string $transmission) {
        parent::__construct($id, $immatriculation, $marque, $modele, $prixJour);
        $this->nbPortes = $nbPortes;
        $this->transmission = $transmission;
    }



    public function getType(): string
    {
        return 'Car';
    }

    public function afficherDetails(): void
    {
        echo "ID: $this->id, $this->nbPortes, $this->transmission, $this->marque $this->modele, Prix/Jour: $this->prixJour DH";        
    }
}


class Moto extends Vehicule
{
    public string $cylindree;

    public function __construct(int $id, string $immatriculation, string $marque, string $modele, float $prixJour, string $cylindree) {
        parent::__construct($id, $immatriculation, $marque, $modele, $prixJour);
        $this->cylindree = $cylindree;
    }

    public function getType(): string
    {
        return 'Moto';
    }   


    public function afficherDetails(): void
    {
        echo "ID: $this->id, $this->cylindree, $this->marque $this->modele, Prix/Jour: $this->prixJour DH";        
    }


}







class Truck extends Vehicule
{
    private int $capaciteTonnage;

    public function __construct(int $id, string $immatriculation, string $marque, string $modele, float $prixJour, int $capaciteTonnage) {
        parent::__construct($id, $immatriculation, $marque, $modele, $prixJour);
        $this->capaciteTonnage = $capaciteTonnage;
    }
    


    public function getType(): string
    {
        return 'Truck';
    }   
}




abstract class Person
{
    protected string $firstName;
    protected string $lastName;
    protected string $email;

    public function __construct($firstName, $lastName, $email)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
    }

    abstract public function displayProfil();
    
    public function getEmail()
    {
      return $this->email;
    }


}




class Client extends Person
{
    private int $numeroClient;
    private $reservations;
    
    public function __construct($numeroClient, $reservations, $firstName, $lastName, $email)
    {
      parent::__construct($firstName, $lastName, $email);
      $this->numeroClient = $numeroClient;
      $this->reservations = $reservations;

      
    }
    
    
    public function addReservation(Reservation $r)
    {
        $this->reservations[] = $r;

    }

    public function getHistorique(): array {
        return $this->reservations;
    }

    public function displayProfil(): void {

        echo "Client: {$this->firstName} {$this->lastName} ({$this->email}) - N° {$this->numeroClient}\n";
    }



}




class Agence
{
    private string $name;
    private string $city;
    private $vehicules = [];
    private $clients = [];

    public function __construct(string $name, string $city) {
        $this->name = $name;
        $this->city = $city;
    }

    public function ajouterVehicule(Vehicule $v): void {
      foreach($this->vehicules as $vehicule)
      {
        if($vehicule->getImmatriculation() === $v->getImmatriculation())
        {
          echo 'vehicule already added' .PHP_EOL;
          return;
        }
      }
        $this->vehicules[] = $v;
        echo 'vehicule added successfully' . PHP_EOL;
        echo $v->afficherDetails() . PHP_EOL;
    }

    public function enregistrerClient(Client $c): void {
      foreach($this->clients as $client)
      {
        if($client->getEmail() === $c->getEmail())
        {
          echo 'client already exists' .PHP_EOL;
          return;
        }
      }
        $this->clients[] = $c;
         echo 'client registered successfully' . PHP_EOL;
        echo $c->displayProfil() . PHP_EOL;
    }



}


class reservations
{
  private $vehicule;
  private $client;
  private $dateDebut;
  private $nbJours;
  private $statut;
  
  public function __construct($vehicule, $client, $dateDebut, $nbJours, $statut)
  {
    $this->vehicule = $vehicule;
    $this->client = $client;
    $this->dateDebut = $dateDebut;
    $this->nbJours = $nbJours;
    $this->statut = $statut;
  }
  
  public function calculerMontant()
  {
    
  }
}




$car = new Car(1, '123-XYZ', 'Toyota', 'Corolla', 300.0, 4, 'Automatique');
$moto = new Moto(2, '456-ABC', 'Yamaha', 'MT-07', 150.0, '700cc');
$truck = new Truck(3, '789-DEF', 'Volvo', 'FH16', 500.0, 18);
$truck2 = new Truck(3, '789-DEF', 'Volvo', 'FH16', 500.0, 18);



$client = new Client(1, 'R1', "Youness", "El Mehdi", "youness@example.com");
$client2 = new Client(1, 'R1', "Youness", "El Mehdi", "youness@example.com");

$agence = new Agence("Fut Rental", "Casablanca");

$agence->enregistrerClient($client);
$agence->enregistrerClient($client2);
$agence->ajouterVehicule($car);
$agence->ajouterVehicule($moto);
$agence->ajouterVehicule($truck);
$agence->ajouterVehicule($truck2);





?>