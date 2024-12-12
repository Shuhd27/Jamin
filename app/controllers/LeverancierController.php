<?php

class LeverancierController extends BaseController
{
    private $leverancierModel;

    public function __construct()
    {
        $this->leverancierModel = $this->model('LeverancierModel'); // Laad het model
    }

    // Toon overzicht van leveranciers
    public function index($limit = LIMIT, $offset = 0)
    {
        $data = [
            'title' => 'Overzicht Leveranciers',
            'message' => null,
            'messageColor' => null,
            'messageVisibility' => 'none',
            'dataRows' => null,
            'pagination' => null
        ];

        $result = $this->leverancierModel->getAllLeveranciers($limit, $offset);

        if (is_null($result)) {
            // Foutafhandeling
            $data['message'] = "Er is een fout opgetreden bij het ophalen van leveranciers.";
            $data['messageColor'] = "danger";
            $data['messageVisibility'] = "flex";
            $data['dataRows'] = null;

            header('Refresh:3; url=' . URLROOT . '/Homepages/index');
        } else {
            $data['dataRows'] = $result;
            $data['pagination'] = new Pagination($result[0]->TotalRows, $limit, $offset, __CLASS__, __FUNCTION__);
        }

        $this->view('leverancier/index', $data); // Toon de leveranciers in de view
    }

    // Toon details van een specifieke leverancier
    public function readLeverancierById($leverancierId)
    {
        $data = [
            'title' => 'Leverancier Informatie',
            'message' => null,
            'messageColor' => null,
            'messageVisibility' => 'none',
            'dataRows' => null
        ];

        $result = $this->leverancierModel->getLeverancierById($leverancierId);

        if (is_null($result)) {
            // Foutafhandeling
            $data['message'] = "Er is een fout opgetreden bij het ophalen van leveranciergegevens.";
            $data['messageColor'] = "danger";
            $data['messageVisibility'] = "flex";
            $data['dataRows'] = null;

            header('Refresh:3; url=' . URLROOT . '/LeverancierController/index');
        } else {
            $data['dataRows'] = $result;
        }

        $this->view('leverancier/readLeverancierById', $data); // Toon de leverancier gegevens in de view
    }

    // Voeg een nieuwe leverancier toe
    public function addLeverancier()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $naam = $_POST['naam'];
            $adres = $_POST['adres'];
            $contact = $_POST['contact'];

            $result = $this->leverancierModel->addLeverancier($naam, $adres, $contact);

            if ($result) {
                header('Location: ' . URLROOT . '/LeverancierController/index');
            } else {
                // Foutafhandeling bij toevoegen
                echo "Er is een fout opgetreden bij het toevoegen van de leverancier.";
            }
        } else {
            // Toon formulier voor het toevoegen van een leverancier
            $this->view('leverancier/addLeverancier');
        }
    }
}
