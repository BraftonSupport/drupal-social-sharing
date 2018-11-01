<?php

namespace Drupal\brafton_social_sharing\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "brafton_social_sharing",
 *   admin_label = @Translation("Brafton social sharing"),
 *   category = @Translation("Custom"),
 * )
 */
class HelloBlock extends BlockBase implements BlockPluginInterface {

  /**
   * {@inheritdoc}
   */
  public function build() {

    $items = [];

    $config = $this->getConfiguration();

    global $base_url;

    $items['page_url'] = Url::fromRoute('<current>', [], ['absolute' => TRUE]);

    $request = \Drupal::request();
    if ($route = $request->attributes->get(\Symfony\Cmf\Component\Routing\RouteObjectInterface::ROUTE_OBJECT)) {
      $title = \Drupal::service('title_resolver')->getTitle($request, $route);
    }

    $items['title'] = $title;

    $items['facebook'] = $config['facebook_url'];
    
    $items['twitter'] = $config['twitter_url'];
    
    $items['google'] = $config['google_url'];
    
    $items['linkedin'] = $config['li_url'];
    
    $items['pinterest'] = $config['pin_url'];
    
    return array(
      '#theme' => 'brafton-social-sharing',
      '#items' => $items,
      '#attached' => array(
        'library' => array(
          'brafton_social_sharing/social-sharing',
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['facebook_url'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Facebook'),
      //'#description' => $this->t('Link to Facebook page'),
      '#default_value' => isset($config['facebook_url']) ? $config['facebook_url'] : '',
    ];

    $form['twitter_url'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Twitter'),
      //'#description' => $this->t('Link to Twitter page'),
      '#default_value' => isset($config['twitter_url']) ? $config['twitter_url'] : '',
    ];

    $form['google_url'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Google +'),
      //'#description' => $this->t('Link to Google + page'),
      '#default_value' => isset($config['google_url']) ? $config['google_url'] : '',
    ];

    $form['li_url'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('LinkedIn'),
      //'#description' => $this->t('Link to LinkedIn page'),
      '#default_value' => isset($config['li_url']) ? $config['li_url'] : '',
    ];

    $form['pin_url'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Pinterest'),
      //'#description' => $this->t('Link to Pinterest page'),
      '#default_value' => isset($config['pin_url']) ? $config['pin_url'] : '',
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['facebook_url'] = $values['facebook_url'];
    $this->configuration['twitter_url'] = $values['twitter_url'];
    $this->configuration['google_url'] = $values['google_url'];
    $this->configuration['li_url'] = $values['li_url'];
    $this->configuration['pin_url'] = $values['pin_url'];
  }
  
}
