<?php

namespace Drupal\slack_event_poster\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Slack Event Poster settings.
 */
class SlackEventPosterSettingsForm extends ConfigFormBase {

  public function getFormId() {
    return 'slack_event_poster_settings_form';
  }

  protected function getEditableConfigNames() {
    return ['slack_event_poster.settings'];
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('slack_event_poster.settings');

    $form['general_channel'] = [
      '#type' => 'textfield',
      '#title' => $this->t('General Events Channel'),
      '#default_value' => $config->get('general_channel'),
      '#description' => $this->t('Enter the default Slack channel for events (e.g., #general-events).'),
    ];

    return parent::buildForm($form, $form_state);
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('slack_event_poster.settings')
      ->set('general_channel', $form_state->getValue('general_channel'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}
