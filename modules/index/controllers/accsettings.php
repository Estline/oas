<?php
/**
 * @filesource modules/index/controllers/accsettings.php
 *
 * @copyright 2016 Goragod.com
 * @license http://www.kotchasan.com/license/
 *
 * @see http://www.kotchasan.com/
 */

namespace Index\Accsettings;

use Gcms\Login;
use Kotchasan\Html;
use Kotchasan\Http\Request;
use Kotchasan\Language;

/**
 * module=accsettings.
 *
 * @author Goragod Wiriya <admin@goragod.com>
 *
 * @since 1.0
 */
class Controller extends \Gcms\Controller
{
    /**
     * ตั้งค่าระบบบัญชี.
     *
     * @param Request $request
     *
     * @return string
     */
    public function render(Request $request)
    {
        // ข้อความ title bar
        $this->title = Language::get('Accounting settings');
        // เลือกเมนู
        $this->menu = 'settings';
        // สามารถตั้งค่าระบบได้
        if ($login = Login::checkPermission(Login::isMember(), 'can_config')) {
            // แสดงผล
            $section = Html::create('section', array(
                'class' => 'content_bg',
            ));
            // breadcrumbs
            $breadcrumbs = $section->add('div', array(
                'class' => 'breadcrumbs',
            ));
            $ul = $breadcrumbs->add('ul');
            $ul->appendChild('<li><a href="index.php" class="icon-settings">{LNG_Home}</a></li>');
            $ul->appendChild('<li><span>{LNG_Settings}</span></li>');
            $ul->appendChild('<li><span>{LNG_Accounting}</span></li>');
            $section->add('header', array(
                'innerHTML' => '<h2 class="icon-billing">'.$this->title.'</h2>',
            ));
            // menu
            $section->appendChild(\Index\Tabmenus\View::render($request, 'settings', 'accsettings'));
            // แสดงฟอร์ม
            $section->appendChild(createClass('Index\Accsettings\View')->render());
            // คืนค่า HTML

            return $section->render();
        }
        // 404

        return \Index\Error\Controller::execute($this);
    }
}
