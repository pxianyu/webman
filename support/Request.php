<?php
/**
 * This file is part of webman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author    walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link      http://www.workerman.net/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */

namespace support;

/**
 * Class Request
 * @package support
 */
class Request extends \Webman\Http\Request
{
    public function input($name = null, $default = null)
    {
        return $this->filter(parent::input($name, $default));
    }

    public function get($name = null, $default = null)
    {
        return $this->filter(parent::get($name, $default));
    }

    public function post($name = null, $default = null)
    {
        return $this->filter(parent::post($name, $default));
    }

    public function all()
    {
        return $this->filter(parent::all());
    }

    public function filter($value)
    {
        if ( ! $value) {
            return $value;
        }
        if (is_array($value)) {
            array_walk_recursive($value, function (&$item) {
                if (is_string($item)) {
                    $item = htmlspecialchars($item);
                }
            });
        } else {
            $value = htmlspecialchars($value);
        }

        return $value;
    }
}