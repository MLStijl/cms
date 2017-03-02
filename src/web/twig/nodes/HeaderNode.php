<?php
/**
 * @link      https://craftcms.com/
 * @copyright Copyright (c) Pixel & Tonic, Inc.
 * @license   https://craftcms.com/license
 */

namespace craft\web\twig\nodes;

use craft\helpers\Header;

/**
 * Class HeaderNode
 *
 * @author Pixel & Tonic, Inc. <support@pixelandtonic.com>
 * @since  3.0
 */
class HeaderNode extends \Twig_Node
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function compile(\Twig_Compiler $compiler)
    {
        $compiler
            ->write('$_headerParts = array_map(\'trim\', explode(\':\', ')
            ->subcompile($this->getNode('header'))
            ->raw(", 2));\n")
            ->write(\Craft::class."::\$app->getResponse()->getHeaders()->set(\$_headerParts[0], \$_headerParts[1] ?? '');\n")
            ->write("unset(\$_headerParts);\n");
    }
}
