<?php

namespace App\Entity;

use App\Repository\CustomerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CustomerRepository::class)
 */
class Customer
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $shippingAddressLine1;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $shippingAddressLine2;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $shippingZipCode;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $shippingCity;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $shippingCountry;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $shippingState;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $billingAddressLine1;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $billingAddressLine2;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $billingZipCode;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $billingCity;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $billingCountry;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $billingState;

    /**
     * @ORM\OneToMany(targetEntity=Order::class, mappedBy="customer")
     */
    private $orders;

    /**
     * @ORM\OneToMany(targetEntity=Rating::class, mappedBy="customer")
     */
    private $ratings;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
        $this->ratings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getShippingAddressLine1(): ?string
    {
        return $this->shippingAddressLine1;
    }

    public function setShippingAddressLine1(string $shippingAddressLine1): self
    {
        $this->shippingAddressLine1 = $shippingAddressLine1;

        return $this;
    }

    public function getShippingAddressLine2(): ?string
    {
        return $this->shippingAddressLine2;
    }

    public function setShippingAddressLine2(string $shippingAddressLine2): self
    {
        $this->shippingAddressLine2 = $shippingAddressLine2;

        return $this;
    }

    public function getShippingZipCode(): ?string
    {
        return $this->shippingZipCode;
    }

    public function setShippingZipCode(string $shippingZipCode): self
    {
        $this->shippingZipCode = $shippingZipCode;

        return $this;
    }

    public function getShippingCity(): ?string
    {
        return $this->shippingCity;
    }

    public function setShippingCity(string $shippingCity): self
    {
        $this->shippingCity = $shippingCity;

        return $this;
    }

    public function getShippingCountry(): ?string
    {
        return $this->shippingCountry;
    }

    public function setShippingCountry(string $shippingCountry): self
    {
        $this->shippingCountry = $shippingCountry;

        return $this;
    }

    public function getShippingState(): ?string
    {
        return $this->shippingState;
    }

    public function setShippingState(string $shippingState): self
    {
        $this->shippingState = $shippingState;

        return $this;
    }

    public function getBillingAddressLine1(): ?string
    {
        return $this->billingAddressLine1;
    }

    public function setBillingAddressLine1(?string $billingAddressLine1): self
    {
        $this->billingAddressLine1 = $billingAddressLine1;

        return $this;
    }

    public function getBillingAddressLine2(): ?string
    {
        return $this->billingAddressLine2;
    }

    public function setBillingAddressLine2(?string $billingAddressLine2): self
    {
        $this->billingAddressLine2 = $billingAddressLine2;

        return $this;
    }

    public function getBillingZipCode(): ?string
    {
        return $this->billingZipCode;
    }

    public function setBillingZipCode(?string $billingZipCode): self
    {
        $this->billingZipCode = $billingZipCode;

        return $this;
    }

    public function getBillingCity(): ?string
    {
        return $this->billingCity;
    }

    public function setBillingCity(?string $billingCity): self
    {
        $this->billingCity = $billingCity;

        return $this;
    }

    public function getBillingCountry(): ?string
    {
        return $this->billingCountry;
    }

    public function setBillingCountry(string $billingCountry): self
    {
        $this->billingCountry = $billingCountry;

        return $this;
    }

    public function getBillingState(): ?string
    {
        return $this->billingState;
    }

    public function setBillingState(?string $billingState): self
    {
        $this->billingState = $billingState;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setCustomer($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->removeElement($order)) {
            // set the owning side to null (unless already changed)
            if ($order->getCustomer() === $this) {
                $order->setCustomer(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Rating[]
     */
    public function getRatings(): Collection
    {
        return $this->ratings;
    }

    public function addRating(Rating $rating): self
    {
        if (!$this->ratings->contains($rating)) {
            $this->ratings[] = $rating;
            $rating->setCustomer($this);
        }

        return $this;
    }

    public function removeRating(Rating $rating): self
    {
        if ($this->ratings->removeElement($rating)) {
            // set the owning side to null (unless already changed)
            if ($rating->getCustomer() === $this) {
                $rating->setCustomer(null);
            }
        }

        return $this;
    }
}
