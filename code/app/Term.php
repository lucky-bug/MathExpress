<?php

namespace App;

use App\Interfaces\SearchableModelInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Term
 *
 * @package App
 * @property int $id
 * @property string $title
 * @property string $body
 */
class Term extends Model implements SearchableModelInterface
{
    protected $fillable = [
        'title',
        'body',
    ];

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Term
     */
    public function setTitle(string $title): Term
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param string $body
     * @return Term
     */
    public function setBody(string $body): Term
    {
        $this->body = $body;

        return $this;
    }

    public static function search(string $key = null)
    {
        if ($key === null) {
            return self::where();
        } else {
            return self::where('title', 'like', '%' . $key . '%')->orWhere('body', 'like', '%' . $key . '%');
        }
    }
}
