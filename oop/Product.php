<?php

/**
 * Klasse Categorie vertegenwoordigt een productcategorie.
 */
class Categorie
{
    /**
     * @var string Naam van de categorie
     */
    private string $naam;

    /**
     * @var string Beschrijving van de categorie
     */
    private string $beschrijving;

    /**
     * Maak een nieuwe categorie aan.
     *
     * @param string $naam
     * @param string $beschrijving
     */
    public function __construct(string $naam, string $beschrijving)
    {
        $this->naam = $naam;
        $this->beschrijving = $beschrijving;
    }

    /**
     * Haal de naam van de categorie op.
     */
    public function getNaam(): string
    {
        return $this->naam;
    }

    /**
     * Stel de naam van de categorie in.
     */
    public function setNaam(string $naam): void
    {
        $this->naam = $naam;
    }

    /**
     * Haal de beschrijving van de categorie op.
     */
    public function getBeschrijving(): string
    {
        return $this->beschrijving;
    }

    /**
     * Stel de beschrijving van de categorie in.
     */
    public function setBeschrijving(string $beschrijving): void
    {
        $this->beschrijving = $beschrijving;
    }
}

/**
 * Klasse Product vertegenwoordigt een product met bijhorende gegevens.
 */
class Product
{
    /**
     * @var string Naam van het product
     */
    private string $naam;

    /**
     * @var float Prijs van het product
     */
    private float $prijs;

    /**
     * @var string Beschrijving van het product
     */
    private string $beschrijving;

    /**
     * @var Categorie|null Categorie waartoe het product behoort
     */
    private ?Categorie $categorie;

    /**
     * Maak een nieuw product aan.
     *
     * @param string         $naam
     * @param float          $prijs
     * @param string         $beschrijving
     * @param Categorie|null $categorie
     */
    public function __construct(string $naam, float $prijs, string $beschrijving, ?Categorie $categorie = null)
    {
        $this->naam = $naam;
        $this->prijs = $prijs;
        $this->beschrijving = $beschrijving;
        $this->categorie = $categorie;
    }

    /**
     * Haal de productnaam op.
     */
    public function getNaam(): string
    {
        return $this->naam;
    }

    /**
     * Stel de productnaam in.
     */
    public function setNaam(string $naam): void
    {
        $this->naam = $naam;
    }

    /**
     * Haal de prijs op.
     */
    public function getPrijs(): float
    {
        return $this->prijs;
    }

    /**
     * Stel de prijs in.
     */
    public function setPrijs(float $prijs): void
    {
        $this->prijs = $prijs;
    }

    /**
     * Haal de beschrijving op.
     */
    public function getBeschrijving(): string
    {
        return $this->beschrijving;
    }

    /**
     * Stel de beschrijving in.
     */
    public function setBeschrijving(string $beschrijving): void
    {
        $this->beschrijving = $beschrijving;
    }

    /**
     * Haal de categorie op.
     */
    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    /**
     * Stel de categorie in.
     */
    public function setCategorie(?Categorie $categorie): void
    {
        $this->categorie = $categorie;
    }

    /**
     * Geef het product weer als HTML.
     */
    public function toonProduct(): string
    {
        $prijsWeergave = number_format($this->prijs, 2, ',', '.');

        $categorieHtml = '';
        if ($this->categorie !== null) {
            $categorieHtml = sprintf('<p class="product__categorie">Categorie: %s</p>', htmlspecialchars($this->categorie->getNaam()));
        }

        return sprintf(
            '<div class="product">'
            . '<h2 class="product__naam">%s</h2>'
            . '%s'
            . '<p class="product__prijs">Prijs: &euro; %s</p>'
            . '<p class="product__beschrijving">%s</p>'
            . '</div>',
            htmlspecialchars($this->naam),
            $categorieHtml,
            $prijsWeergave,
            nl2br(htmlspecialchars($this->beschrijving))
        );
    }
}
