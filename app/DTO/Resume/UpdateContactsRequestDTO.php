<?php declare(strict_types=1);

namespace App\DTO\Resume;

use App\Traits\FilterDataTrait;
readonly class UpdateContactsRequestDTO
{
    use FilterDataTrait;
    public function __construct(
        public string|null $phone = null,
        public string|null $email = null,
        public string|null $preferred_contact = null,
    )
    {
    }
    public function toArray(): array
    {
        $data = [
            'phone' => $this->phone,
            'email' => $this->email,
            'preferred_contact' => $this->preferred_contact,
        ];

        return $this->filterData($data);
    }
}
