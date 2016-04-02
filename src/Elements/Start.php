<?php

/**
 * Contao Open Source CMS
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package    semantic_html5
 * @copyright  MEN AT WORK 2016
 * @author     David Maack <david.maack@arcor.de>
 * @license    LGPL-3.0+
 */

namespace SemanticHTML5\Elements;

/**
 * Semantic html5 start element
 * 
 * @property string $sh5_additional* 
 * @property string $sh5_type* 
 */
class Start extends \ContentElement
{

    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'ce_semantic_html5_start';

    /**
     * Generate the content element
     */
    protected function compile()
    {
        //parse all extra attributes
        $attributes = '';
        if ($this->sh5_additional) {
            /** @var array $additionalAttributes */
            $additionalAttributes = deserialize($this->sh5_additional, true);

            foreach ($additionalAttributes as $additional) {
                switch ($additional['property']) {
                    case 'class':
                            if (!empty($additional['value'])) {
                                $this->cssID = array($this->cssID[0], $this->cssID[1] . ' ' . $additional['value']);
                            }
                                
                        break;
                    case 'id':
                        //just do not add ids! This should be done in the id - css field
                        break;
                    default:
                        $attributes .= ' ' . $additional['property'] . ((!empty($additional['value'])) ? '="' . specialchars($additional['value']) . '"' : '');
                }
            }
        }
        $this->Template->sh5_additional = $attributes;

        //render BE-Template
        if (TL_MODE == 'BE') {
            $this->Template = new \BackendTemplate('be_wildcard');
            $this->Template->wildcard = sprintf("&lt;%s%s%s%s&gt;",
                    $this->sh5_type,
                    ($this->cssID[0]) ? ' id="' . $this->cssID[0] . '"' : '',
                    ' class="' . trim('ce_' . $this->type . ' ' . $this->cssID[1]) . '"',
                    $attributes
            );

            return $this->Template->parse();
        }
    }
}
