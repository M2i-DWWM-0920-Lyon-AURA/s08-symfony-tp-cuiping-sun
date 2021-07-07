<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

use App\Repository\MealRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=MealRepository::class)
 */
class Meal
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Assert\NotBlank(message = "Name cannot be empty.")
     * @Assert\Length(
     *          min = 1,
     *          max = 50,
     *          minMessage = "Name must be at least {{ limit }} characters long",
     *          maxMessage = "Name cannot be longer than {{ limit }} characters",
     * )
     * @Assert\NotNull
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Assert\NotBlank(message = "Category cannot be empty.")
     * @Assert\Length(
     *          min = 1,
     *          max = 50,
     *          minMessage = "Category must be at least {{ limit }} characters long",
     *          maxMessage = "Category cannot be longer than {{ limit }} characters",
     * )
     * @Assert\NotNull
     * @ORM\Column(type="string", length=255)
     */
    private $category;

    /**
     * @Assert\NotBlank(message = "Area cannot be empty.")
     * @Assert\Length(
     *          min = 1,
     *          max = 50,
     *          minMessage = "Area must be at least {{ limit }} characters long",
     *          maxMessage = "Area cannot be longer than {{ limit }} characters",
     * )
     * @Assert\NotNull
     * @ORM\Column(type="string", length=255)
     */
    private $area;

    /**
     * @Assert\NotBlank(message = "Image cannot be empty.")
     * @Assert\Url(
     *          message = "The url '{{ value }}' is not a valid url",
     * )
     * @Assert\NotNull
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=Instruction::class, mappedBy="meal")
     */
    private $instruction;

    /**
     * @ORM\OneToMany(targetEntity=Ingredient::class, mappedBy="meal")
     */
    private $ingredient;

    public function __construct()
    {
        $this->instruction = new ArrayCollection();
        $this->ingredient = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getArea(): ?string
    {
        return $this->area;
    }

    public function setArea(string $area): self
    {
        $this->area = $area;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|instruction[]
     */
    public function getInstruction(): Collection
    {
        return $this->instruction;
    }

    public function addInstruction(instruction $instruction): self
    {
        if (!$this->instruction->contains($instruction)) {
            $this->instruction[] = $instruction;
            $instruction->setMeal($this);
        }

        return $this;
    }

    public function removeInstruction(instruction $instruction): self
    {
        if ($this->instruction->removeElement($instruction)) {
            // set the owning side to null (unless already changed)
            if ($instruction->getMeal() === $this) {
                $instruction->setMeal(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Ingredient[]
     */
    public function getIngredient(): Collection
    {
        return $this->ingredient;
    }

    public function addIngredient(Ingredient $ingredient): self
    {
        if (!$this->ingredient->contains($ingredient)) {
            $this->ingredient[] = $ingredient;
            $ingredient->setMeal($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): self
    {
        if ($this->ingredient->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getMeal() === $this) {
                $ingredient->setMeal(null);
            }
        }

        return $this;
    }
}
