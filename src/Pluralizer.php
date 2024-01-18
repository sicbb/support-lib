<?php

namespace Izzle\Support;

use Doctrine\Common\Inflector\Inflector;

class Pluralizer
{
    /**
     * Uncountable word forms.
     *
     * @var array
     */
    public static $uncountable = [
        'audio',
        'bison',
        'chassis',
        'compensation',
        'coreopsis',
        'data',
        'deer',
        'education',
        'emoji',
        'equipment',
        'evidence',
        'feedback',
        'fish',
        'furniture',
        'gold',
        'information',
        'jedi',
        'knowledge',
        'love',
        'metadata',
        'money',
        'moose',
        'nutrition',
        'offspring',
        'plankton',
        'pokemon',
        'police',
        'rain',
        'rice',
        'series',
        'sheep',
        'species',
        'swine',
        'traffic',
        'wheat',
    ];
    
    /**
     * Get the plural form of an English word.
     *
     * @param string $value
     * @param int $count
     * @return string
     */
    public static function plural(string $value, int $count = 2)
    {
        if ((int) $count === 1 || static::uncountable($value)) {
            return $value;
        }
        
        $plural = Inflector::pluralize($value);
        
        return static::matchCase($plural, $value);
    }
    
    /**
     * Get the singular form of an English word.
     *
     * @param string $value
     * @return string
     */
    public static function singular(string $value)
    {
        $singular = Inflector::singularize($value);
        
        return static::matchCase($singular, $value);
    }
    
    /**
     * Determine if the given value is uncountable.
     *
     * @param string $value
     * @return bool
     */
    protected static function uncountable(string $value)
    {
        return in_array(strtolower($value), static::$uncountable, true);
    }
    
    /**
     * Attempt to match the case on two strings.
     *
     * @param string $value
     * @param string $comparison
     * @return string
     */
    protected static function matchCase(string $value, string $comparison)
    {
        $functions = ['mb_strtolower', 'mb_strtoupper', 'ucfirst', 'ucwords'];
        
        foreach ($functions as $function) {
            if (call_user_func($function, $comparison) === $comparison) {
                return call_user_func($function, $value);
            }
        }
        
        return $value;
    }
}
