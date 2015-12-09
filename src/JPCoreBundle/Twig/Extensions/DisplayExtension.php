<?php

namespace JPCoreBundle\Twig\Extensions;

/**
 * Class DisplayExtension
 *
 * @author Jana Polakova <jana.polakova@icloud.com>
 * @package JP\CoreBundle\Twig\Extension
 */
class DisplayExtension extends \Twig_Extension {
    /**
     * Get functions
     *
     * @return array
     */
    public function getFunctions(){
        return [new \Twig_SimpleFunction('message', [$this, 'messageFunction'], ['is_safe' => ['html']])];
    }

    /**
     * Message.
     *
     * @param string $type
     * @param string $message
     * @return string
     */
    public function messageFunction($type, $message){
        return '
            <div class="alert alert-' . $type . '">
                <button class="close" data-dismiss="alert">
                    <i class="fa fa-times"></i>
                </button>' . $message .
            '</div>'
        ;
    }

    /**
     * @return string
     */
    public function getName(){
        return 'twig_display';
    }
}