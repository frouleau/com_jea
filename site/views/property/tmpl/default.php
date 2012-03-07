<?php
/**
 * This file is part of Joomla Estate Agency - Joomla! extension for real estate agency
 *
 * @version     $Id$
 * @package     Joomla.Site
 * @subpackage  com_jea
 * @copyright   Copyright (C) 2008 - 2012 PHILIP Sylvain. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


// no direct access
defined('_JEXEC') or die('Restricted access');

if (empty($this->row->id)) {
    echo JText::_('This property doesn\'t exists anymore');
    return;
}



JHTML::stylesheet('media/com_jea/css/jea.css');
$dispatcher = JDispatcher::getInstance();
JPluginHelper::importPlugin('jea');
?>

<p class="pagenavigation">
<?php // echo $this->getPrevNextItems( $this->row->id ) ?>
</p>

<?php if ($this->params->get('show_print_icon')): ?>
<div class="jea_tools">
<?php if ( $this->params->get('show_print_icon') ): ?>
  <!-- <a href="javascript:window.print()" title="<?php echo JText::_('Print') ?>"><?php echo JHTML::_('image.site', 'printButton.png') ?></a> -->
<?php endif ?>
</div>
<?php endif ?>

<h1><?php echo $this->page_title ?></h1>

<?php if ( $this->params->get('show_creation_date', 0) ) : ?>
<p>
  <span class="date"> <?php echo JHTML::_('date',  $this->row->created, JText::_('DATE_FORMAT_LC3') ); ?></span>
</p>
<?php endif ?>

<?php if(!empty($this->row->images)): ?>
<div id="jea-gallery">
<?php echo $this->loadTemplate('squeezebox') ?>
</div>
<?php endif ?>

<h2><?php echo JText::_('Ref')?> : <?php echo $this->escape($this->row->ref) ?></h2>

<div class="clr">&nbsp;</div>

<div class="item_second_column">
  <h3><?php echo JText::_('Adress') ?>:</h3>
  <strong> <?php if($this->row->address) echo $this->escape( $this->row->address ).", <br /> \n" ?>
  <?php if ($this->row->zip_code) echo $this->escape( $this->row->zip_code ) ?> 
  <?php if ($this->row->town) echo strtoupper( $this->escape($this->row->town) )."<br /> \n" ?>
  </strong>
  <?php if ($this->row->area)
  echo JText::_('Area') . ' : <strong>'   .$this->escape( $this->row->area ). "</strong>\n" ?>

  <?php if (!empty($this->row->amenities)) : ?>
  <h3><?php echo JText::_('Advantages')?></h3>
  <?php echo JHtml::_('amenities.bindList', $this->row->amenities, 'ul') ?>
  <?php endif  ?>
</div>

  <?php if (intval($this->row->availability)): ?>
<p>
  <em><?php echo JText::_('Availability date') ?> : <?php echo $this->row->availability ?> </em>
</p>
  <?php endif  ?>

<table>

  <tr>
    <td><?php echo $this->row->transaction_type == 'RENTING' ?  JText::_('Renting price') : JText::_('Selling price') ?></td>
    <td>: <strong><?php echo $this->formatPrice( floatval($this->row->price) , JText::_('Consult us') ) ?></strong></td>
  </tr>

  <?php if ($this->row->charges): ?>
  <tr>
    <td><?php echo JText::_('Charges') ?></td>
    <td>: <strong><?php echo $this->formatPrice( floatval($this->row->charges), JText::_('Consult us') ) ?></strong></td>
  </tr>
  <?php endif  ?>

  <?php if ( $this->row->is_renting &&  floatval($this->row->deposit) > 0 ): ?>
  <tr>
    <td><?php echo JText::_('Deposit') ?></td>
    <td>: <strong><?php echo $this->formatPrice( floatval($this->row->deposit), '0' ) ?> </strong></td>
  </tr>
  <?php endif  ?>

  <?php if ($this->row->fees): ?>
  <tr>
    <td><?php echo JText::_('Fees') ?></td>
    <td>: <strong><?php echo $this->formatPrice( floatval($this->row->fees), JText::_('Consult us') ) ?></strong></td>
  </tr>
  <?php endif  ?>
</table>

<h3><?php echo JText::_('Description') ?> : </h3>
<?php if ($this->row->condition): ?>
<p><strong><?php echo ucfirst($this->escape($this->row->condition)) ?> </strong></p>
<?php endif  ?>

<p>
<?php
if ($this->row->living_space) {
    echo  JText::_( 'Living space' ) . ' : <strong>' . $this->row->living_space . ' '
    . $this->params->get( 'surface_measure' ) . '</strong>' .PHP_EOL ;
}?>
  <br />

  <?php
  if ($this->row->land_space) {
      echo  JText::_( 'Land space' ) . ' : <strong>' . $this->row->land_space  .' '
      . $this->params->get('surface_measure'). '</strong>' .PHP_EOL ;
  }?>
  <br />

  <?php if ( $this->row->rooms ): ?>
  <?php echo JText::_('Number of rooms') ?>
  : <strong><?php echo $this->row->rooms ?> </strong> <br />
  <?php endif  ?>

  <?php if ( $this->row->floor ): ?>
  <?php echo JText::_('Number of floors') ?>
  : <strong><?php echo $this->row->floor ?> </strong> <br />
  <?php endif  ?>

  <?php if ( $this->row->bathrooms ): ?>
  <?php echo JText::_('Number of bathrooms') ?>
  : <strong><?php echo $this->row->bathrooms ?> </strong> <br />
  <?php endif  ?>

  <?php if ($this->row->toilets): ?>
  <?php echo JText::_('Number of toilets') ?>
  : <strong><?php echo $this->row->toilets ?> </strong>
  <?php endif  ?>

</p>

<p>
<?php if ( $this->row->heating_type_name ): ?>
<?php echo JText::_('Hot water type') ?>
  : <strong><?php echo ucfirst($this->escape( $this->row->heating_type_name )) ?> </strong><br />
  <?php endif  ?>

  <?php if ( $this->row->hot_water_type_name ): ?>
  <?php echo JText::_('Heating type') ?>
  : <strong><?php echo ucfirst($this->escape( $this->row->hot_water_type_name )) ?> </strong>
  <?php endif  ?>
</p>


<div class="clr">&nbsp;</div>

  <?php $dispatcher->trigger('onBeforeShowDescription', array(&$this->row)) ?>

<div class="item_description">
<?php echo $this->row->description ?>
</div>

<?php $dispatcher->trigger('onAfterShowDescription', array(&$this->row)) ?>

<?php if ( $this->params->get('show_googlemap') ): ?>
<h3>
<?php echo JText::_('Property geolocalization') ?>
  :
</h3>
<?php // echo $this->showGoogleMap($this->row) ?>
<?php endif ?>

<?php if ( $this->params->get('show_contactform') ): ?>

<form action="<?php echo JRoute::_('index.php?option=com_jea&task=property.sendmail') ?>" method="post" enctype="application/x-www-form-urlencoded">

  <fieldset>
    <legend>
    <?php echo JText::_('FORMCONTACTLEGEND') ?>
    </legend>
    <p>
      <label for="name"><?php echo JText::_('Name') ?> :</label><br /> <input type="text"
        name="name" id="name" value="<?php echo $this->escape(JRequest::getVar('name', '')) ?>"
        size="40" />
    </p>

    <p>
      <label for="email"><?php echo JText::_('Email') ?> :</label><br /> <input type="text"
        name="email" id="email" value="<?php echo $this->escape(JRequest::getVar('email', '')) ?>"
        size="40" />
    </p>

    <p>
      <label for="subject"><?php echo JText::_('Subject') ?> :</label><br /> <input type="text"
        name="subject" id="subject" value="Ref : <?php echo $this->escape( $this->row->ref ) ?>"
        size="40" />
    </p>

    <p>
      <label for="e_message"><?php echo JText::_('Message') ?> :</label><br />
      <textarea name="e_message" id="e_message" rows="10" cols="40">
      <?php echo $this->escape(JRequest::getVar('e_message', '')) ?>
      </textarea>
    </p>

    <?php $dispatcher->trigger('onFormCaptchaDisplay') ?>

    <p>
      <input type="hidden" name="created_by" value="<?php echo $this->row->created_by ?>" />
      <?php echo JHTML::_( 'form.token' ) ?>
      <input type="submit" value="<?php echo JText::_('Send') ?>" />
    </p>
    

  </fieldset>
</form>
      <?php endif  ?>

<p>
  <a href="javascript:window.history.back()" class="jea_return_link"><?php echo JText::_('Back')?> </a>
</p>