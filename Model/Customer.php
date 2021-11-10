<?php

declare(strict_types=1);

class Customer {
    private int $id;
    private string $firstName;
    private string $lastName;
    private int $groupId;
    private ?int $fixedDiscount;
    private ?int $variableDiscount;



    public function __construct(
        int $id,
        string $firstName,
        string $lastName,
        int $groupId,
        ?int $fixedDiscount,
        ?int $variableDiscount
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->groupId = $groupId;
        $this->fixedDiscount = $fixedDiscount;
        $this->variableDiscount = $variableDiscount;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function getGroupId(): int {
        return $this->groupId;
    }

    public function getFixedDiscount(): ?int {
        return $this->fixedDiscount;
    }

    public function getVariableDiscount(): ?int {
        return $this->variableDiscount;
    }
}
