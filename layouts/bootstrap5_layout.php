<?php

use Joomla\CMS\Language\Text;
use \Joomla\CMS\Date\Date;
use Joomla\CMS\Factory;


defined('_JEXEC') or die('Restricted access');

Factory::getApplication()->getDocument()->getWebAssetManager()
    ->useScript('bootstrap.popover')
    ->useStyle('wtdigitallysignedpdfstyle');

/**
 * @var $displayData array Digital sign data
 * Use
 *      echo '<pre>';
 *		print_r($displayData);
 *		echo '</pre>';
 *
 * Информация в массиве с данными подписи может быть очень разная в зависимости от типа подписи, производителя.
 * Поэтому смотрим массив $displayData и отображаем только нужную информацию.
 * Array
 *   (
 *       [pdf_date_modified] => дата последнего изменения pdf-файла. Как правило, это дата подписания.
 *       [inn] => ИНН
 *       [snils] => СНИЛС
 *       [email] => электронная почта
 *       [country] => RU - двухсимвольный код страны
 *       [province] => регион/область
 *       [city] => город
 *       [organisation] => название организации
 *       [given_name] => имя и отчество должностного лица
 *       [surname] => фамилия должностного лица
 *       [common_name] => Ф.И.О. целиком
 *       [post] => должность
 *       [cert_date_start] => дата начала действия сертификата электронной подписи
 *       [cert_date_end] => дата окончания действия сертификата электронной подписи
 *       [serial_number] => серийный номер
 *       [link_to_file] => ссылка на файл
 *       [sign_icon] => иконка ЭЦП из настроек плагина
 *   )
 *
 */
$cert_date_start = new Date($displayData['cert_date_start']);
$cert_date_end = new Date($displayData['cert_date_end']);
?>

<div class="document-wrapper position-relative">
    <img src="<?php echo $displayData['sign_icon'] ?>" alt="Документ подписан цифровой подписью"/> <a href="<?php echo $link_to_file ?>" class="hasTooltip" target="_blank" aria-describedby="tooltip-container">Скачать файл</a>
    <div id="tooltip-container" role="tooltip">
        <p>Документ подписан электронной подписью:</p>
        <ul class="">
            <li><strong>Организация:</strong> <?php echo htmlspecialchars($displayData['organisation']) ?></li>
            <li><strong>Директор:</strong> <?php echo htmlspecialchars($displayData['common_name']) ?></li>
            <li><strong>Дата создания:</strong> <?php echo $displayData['pdf_date_modified'] ?></li>
            <li><strong>Сертификат:</strong> <?php echo $displayData['serial_number'] ?></li>
            <li><strong>Период действия сертификата:</strong> <?php echo $cert_date_start->format(Text::_('DATE_FORMAT_FILTER_DATE')).'-'.$cert_date_end->format(Text::_('DATE_FORMAT_FILTER_DATE')) ?></li>
        </ul>
    </div>
</div>
