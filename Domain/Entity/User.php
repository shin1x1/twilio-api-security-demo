<?php
namespace App\Domain\Entity;

class User
{
    /**
     * @var string
     */
    private $telNo;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $point;

    /**
     * User constructor.
     * @param string $telNo
     * @param string $name
     * @param int $point
     */
    public function __construct(string $telNo, string $name, int $point)
    {
        $this->telNo = $telNo;
        $this->name = $name;
        $this->point = $point;
    }

    public function getMessage(): string
    {
        return sprintf('%sさんのポイントは %d ポイントです。', $this->name, $this->point);
    }
}
