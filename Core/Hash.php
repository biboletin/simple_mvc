<?php


namespace Core;

use Core\Config;

/**
 * Class Hash
 *
 * @package Core
 */
class Hash
{
    /**
     * @var string
     */
    private string $algorithm;
    /**
     * @var array
     */
    private array $options;

    /**
     * Hash constructor.
     */
    public function __construct()
    {
        $this->algorithm = Config::get('security.algorithm');
        $this->options = [
            'cost' => Config::get('security.cost'),
        ];
    }

    /**
     * Hash string/password
     *
     * @param null $string
     *
     * @return string
     */
    public function hashit($string = null): string
    {
        if (($string === null) || ($string === '')) {
            die('Nothing to hash!');
        }
        return password_hash($string, $this->algorithm, $this->options);
    }

    /**
     * @param null $string
     * @param null $hash
     *
     * @return bool
     */
    public function verify($string = null, $hash = null): bool
    {
        return password_verify($string, $hash);
    }
}
