<?php namespace F13\WordPress\Views;

class Shortcode
{
    public $label_author;
    public $label_created;
    public $label_descritpion;
    public $label_download_version;
    public $label_downloads;
    public $label_last_updated;
    public $label_on_wordpress;
    public $label_php_version;
    public $label_rating;
    public $label_rating_from_ratings;
    public $label_requirements;
    public $label_requires_wordpress;
    public $label_tags;
    public $label_tested_with_wordpress;
    public $label_toggle_requirements;
    public $label_version;

    public $plugins_url;

    public function __construct($params = array())
    {
        foreach ($params as $k=>$v) {
            $this->{$k} = $v;
        }

        $this->label_author                 = __('Author', 'f13-wordpress');
        $this->label_created                = __('Created', 'f13-wordpress');
        $this->label_description            = __('Description', 'f13-wordpress');
        $this->label_download_version       = __('Download version %s', 'f13-wordpress');
        $this->label_downloads              = __('Downloads', 'f13-wordpress');
        $this->label_error                  = __('Error', 'f13-wordpress');
        $this->label_last_updated           = __('Last updated', 'f13-wordpress');
        $this->label_on_wordpress           = __('%s on WordPress', 'f13-wordpress');
        $this->label_php_version            = __('Requires PHP', 'f13-wordpress');
        $this->label_rating                 = __('Rating', 'f13-wordpress');
        $this->label_rating_from_ratings    = __('%s/5 from %d rating', 'f13-wordpress');
        $this->label_requirements           = __('Requirements', 'f13-wordpress');
        $this->label_requires_wordpress     = __('Requires WordPress', 'f13-wordpress');
        $this->label_tags                   = __('Tags', 'f13-wordpress');
        $this->label_tested_with_wordpress  = __('Tested with WordPress', 'f13-wordpress');
        $this->label_toggle_requirements    = __('Toggle requirements', 'f13-wordpress');
        $this->label_version                = __('Version', 'f13-wordpress');

        $this->plugins_url = 'https://wordpress.org/plugins/';
    }

    public function _get_stars($rating = 0)
    {
        $rating = $rating / 20;
        $v = '';
        for ($i = 1; $i < 6; $i++) {
            if ($rating > $i) {
                $v .= '<span class="dashicons dashicons-star-filled"></span>';
            } elseif ($rating > $i - 0.5) {
                $v .= '<span class="dashicons dashicons-star-half"></span>';
            } else {
                $v .= '<span class="dashicons dashicons-star-empty"></span>';
            }
        }

        return $v;
    }

    public function plugin()
    {
        if (property_exists($this->data, 'error')) {
            return '<div class="f13-wordpress-error">'.$this->label_error.': '.htmlentities($this->data->error).'</div>';
        }
        $v = '<div class="f13-wordpress-container">';
            $v .= '<div class="f13-wordpress-header">';
                $v .= '<span class="dashicons dashicons-wordpress"></span>';
                $v .= '<a class="f13-wordpress-slug" href="'.$this->plugins_url.$this->data->slug.'" target="_blank" title="'.sprintf($this->label_on_wordpress, $this->data->name).'">';
                    $v .= $this->data->name;
                $v .= '</a>';
            $v .= '</div>';
            $v .= '<div class="f13-wordpress-description">';
                $v .= '<div class="f13-wordpress-plugin">';
                    $v .= '<div>';
                    $v .= '</div>';
                    $v .= '<div>';
                        $v .= '<strong>'.$this->label_author.':</strong>';
                        $v .= '<a href="'.$this->data->author_profile.'" target="_blank" title="'.sprintf($this->label_on_wordpress, wp_strip_all_tags($this->data->author)).'">';
                            $v .= wp_strip_all_tags($this->data->author);
                        $v .= '</a>';
                    $v .= '</div>';
                $v .= '</div>';
                $v .= '<div class="f13-wordpress-rating">';
                    $v .= '<strong>'.$this->label_rating.':</strong>';
                    $v .= $this->_get_stars($this->data->rating);
                    $v .= ' ('.sprintf($this->label_rating_from_ratings, round($this->data->rating / 20, 1), $this->data->num_ratings).')';
                $v .= '</div>';
                $v .= '<div class="f13-wordpress-excerpt">';
                    $v .= '<strong>'.$this->label_description.':</strong>';
                    $v .= substr($this->data->sections->description, 0, 200).'...';
                $v .= '</div>';
                $v .= '<div class="f13-wordpress-tags">';
                    $v .= '<strong>'.$this->label_tags.':</strong>';
                    $v .= '<div>';
                        foreach ($this->data->tags as $tag) {
                            $v .= '<span class="f13-wordpress-tag">'.$tag.'</span>';
                        }
                    $v .= '</div>';
                $v .= '</div>';
                $v .= '<div class="f13-wordpress-download">';
                    $v .= '<strong>'.$this->label_downloads.':</strong>';
                    $v .= $this->data->downloaded;
                $v .= '</div>';
                $v .= '<div class="f13-wordpress-hr"></div>';
                $v .= '<div class="f13-wordpress-links">';
                    $v .= '<a class="f13-wordpress-button" href="'.$this->data->download_link.'">';
                        $v .= sprintf($this->label_download_version, $this->data->version);
                    $v .= '</a>';
                $v .= '</div>';
                $v .= '<details class="f13-wordpress-requirements">';
                    $v .= '<summary><a title="'.$this->label_toggle_requirements.'" tabindex="-1">'.$this->label_requirements.'</a></summary>';
                    $v .= '<div>';
                        $v .= '<span class="f13-wordpress-requirement">';
                            $v .= '<strong>'.$this->label_version.':</strong>'.$this->data->version;
                        $v .= '</span>';
                        $v .= '<span class="f13-wordpress-requirement">';
                            $v .= '<strong>'.$this->label_requires_wordpress.':</strong>'.$this->data->requires.'+';
                        $v .= '</span>';
                        $v .= '<span class="f13-wordpress-requirement">';
                            $v .= '<strong>'.$this->label_tested_with_wordpress.':</strong>'.$this->data->tested;
                        $v .= '</span>';
                        $v .= '<span class="f13-wordpress-requirement">';
                            $v .= '<strong>'.$this->label_php_version.':</strong>'.$this->data->requires_php.'+';
                        $v .= '</span>';
                        $v .= '<span class="f13-wordpress-requirement">';
                            $v .= '<strong>'.$this->label_created.':</strong>'.date('F j, Y', strtotime($this->data->added));
                        $v .= '</span>';
                        $v .= '<span class="f13-wordpress-requirement">';
                            $v .= '<strong>'.$this->label_last_updated.':</strong>'.date('F j, Y g:ia', strtotime($this->data->last_updated));
                        $v .= '</span>';
                    $v .= '</div>';
                $v .= '</details>';
            $v .= '</div>';
        $v .= '</div>';

        return $v;
    }
}
