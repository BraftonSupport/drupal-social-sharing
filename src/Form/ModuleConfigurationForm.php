<?php

namespace Drupal\brafton_social_sharing\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class ModuleConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'brafton_social_sharing_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'brafton_social_sharing.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('brafton_social_sharing.settings');
      $form['facebook_url'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Facebook'),
        //'#description' => $this->t('Link to Facebook page'),
        '#default_value' => $config->get('brafton_social_sharing.facebook_url'),
      ];
  
      $form['twitter_url'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Twitter'),
        //'#description' => $this->t('Link to Twitter page'),
        '#default_value' => $config->get('brafton_social_sharing.twitter_url'),
      ];
  
      $form['google_url'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Google +'),
        //'#description' => $this->t('Link to Google + page'),
        '#default_value' => $config->get('brafton_social_sharing.google_url'),
      ];
  
      $form['li_url'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('LinkedIn'),
        //'#description' => $this->t('Link to LinkedIn page'),
        '#default_value' => $config->get('brafton_social_sharing.li_url'),
      ];
  
      $form['pin_url'] = [
        '#type' => 'checkbox',
        '#title' => $this->t('Pinterest'),
        //'#description' => $this->t('Link to Pinterest page'),
        '#default_value' => $config->get('brafton_social_sharing.pin_url'),
      ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('brafton_social_sharing.settings');
    $config->set('brafton_social_sharing.facebook_url', $form_state->getValue('facebook_url'));
    $config->set('brafton_social_sharing.twitter_url', $form_state->getValue('twitter_url'));
    $config->set('brafton_social_sharing.google_url', $form_state->getValue('google_url'));
    $config->set('brafton_social_sharing.li_url', $form_state->getValue('li_url'));
    $config->set('brafton_social_sharing.pin_url', $form_state->getValue('pin_url'));
    $config->save();
    return parent::submitForm($form, $form_state);
  }

}