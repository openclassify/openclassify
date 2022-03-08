<?php

return [

    // Old crap
    'secondary'              => '#ff0',

    // Colors
    'purple'                 => '#61259e',
    'green'                  => '#24ce7b',
    'blue'                   => '#38b5e6',
    'orange'                 => '#f48714',
    'red'                    => '#f6303e',

    // Grayscale
    'gray-dark'              => '#353535',
    'gray'                   => '#3e3e3e',
    'gray-light'             => '#818a91',
    'gray-lighter'           => '#eceeef',
    'gray-lightest'          => '#f7f7f9',
    'white'                  => '#ffffff',

    // Branding
    'brand-primary'          => '#2c3e50',
    'brand-success'          => '#24ce7b',
    'brand-info'             => '#38b5e6',
    'brand-warning'          => '#f69630',
    'brand-danger'           => '#f6303e',

    // Body
    'body-bg'                => '#f1f2f3',
    'body-color'             => '#353535',

    // Links
    'link-color'             => '#38b5e6',
    'link-decoration'        => 'none',

    // Typography
    'font-family-sans-serif' => '"Proxima Nova", "Helvetica Neue", Helvetica, Arial, sans-serif',
    'font-family-serif'      => 'Georgia, "Times New Roman", Times, serif',
    'font-family-monospace'  => 'Menlo, Monaco, Consolas, "Courier New", monospace',
    'font-family-base'       => '"Proxima Nova", "Helvetica Neue", Helvetica, Arial, sans-serif',

    // Fonts
    'font-size-root'         => '16px',
    'font-size-base'         => '1rem',
    'font-size-lg'           => '1.25rem',
    'font-size-sm'           => '.875rem',
    'font-size-xs'           => '.75rem',
    'font-size-h1'           => '2.25rem',
    'font-size-h2'           => '1.75rem',
    'font-size-h3'           => '1.5rem',
    'font-size-h4'           => '1.25rem',
    'font-size-h5'           => '1.1rem',
    'font-size-h6'           => '1rem',

    'line-height' => 1.5,

    'lead-font-size'         => '1.25rem',
    'lead-font-weight'       => 300,
    'text-muted'             => '#818a91',
    'text-faded'             => '#bfc7c9',
    'abbr-border-color'      => '#818a91',
    'blockquote-small-color' => '#818a91',

    // Components
    'line-height-lg'         => (4 / 3),
    'line-height-sm'         => 1.5,

    'border-radius'         => '0',
    'border-radius-lg'      => '0',
    'border-radius-sm'      => '0',

    // Tables
    'table-cell-padding'    => '.75rem',
    'table-sm-cell-padding' => '.3rem',


    'table-bg'        => 'transparent',
    'table-bg-accent' => '#f9f9f9',
    'table-bg-hover'  => '#f5f5f5',
    'table-bg-active' => '#f5f5f5',

    //'table-border-color' => '#818a91',

    /*// Buttons
    //
    // For each of Bootstrap's buttons, define text, background and border color.

    $btn-padding-x: 1rem !default;
    $btn-padding-y: .375rem !default;
    $btn-font-weight: normal !default;

    $btn-primary-color: #ffffff !default;
    $btn-primary-bg: $brand-primary !default;
    $btn-primary-border: $btn-primary-bg !default;

    $btn-secondary-color: $gray-dark !default;
    $btn-secondary-bg: #ffffff !default;
    $btn-secondary-border: #6f6f6f !default;

    $btn-info-color: #ffffff !default;
    $btn-info-bg: $brand-info !default;
    $btn-info-border: $btn-info-bg !default;

    $btn-success-color: #ffffff !default;
    $btn-success-bg: $brand-success !default;
    $btn-success-border: $btn-success-bg !default;

    $btn-warning-color: #ffffff !default;
    $btn-warning-bg: $brand-warning !default;
    $btn-warning-border: $btn-warning-bg !default;

    $btn-danger-color: #ffffff !default;
    $btn-danger-bg: $brand-danger !default;
    $btn-danger-border: $btn-danger-bg !default;

    $btn-link-disabled-color: $gray-light !default;

    $btn-padding-x-sm: .75rem !default;
    $btn-padding-y-sm: .25rem !default;

    $btn-padding-x-lg: 1.25rem !default;
    $btn-padding-y-lg: .75rem !default;

    // Allows for customizing button radius independently from global border radius
    $btn-border-radius: $border-radius !default;
    $btn-border-radius-lg: $border-radius-lg !default;
    $btn-border-radius-sm: $border-radius-sm !default;
*/

    // Forms
    'input-padding-x' => '.75rem',
    'input-padding-y' => '.375rem',

    'input-bg'          => '#ffffff',
    'input-bg-disabled' => '#eceeef',

    'input-color'            => '#3e3e3e',
    'input-border-color'     => '#cccccc',
    'input-btn-border-width' => '1px',
    'input-box-shadow'       => 'inset 0 1px 1px rgba(0, 0, 0, .075)',

    'input-border-radius'    => '.25rem',
    'input-border-radius-lg' => '.3rem',
    'input-border-radius-sm' => '.2rem',

    'input-border-focus'      => '#38b5e6',
    'input-box-shadow-focus'  => 'rgba(102, 175, 233, .6)',
    'input-color-placeholder' => '#999999',

    'input-padding-x-sm' => '.75rem',
    'input-padding-y-sm' => '.275rem',

    'input-padding-x-lg'    => '1.25rem',
    'input-padding-y-lg'    => '.75rem',

    /*

    $input-height: (($font-size-base * $line-height) + ($input-padding-y * 2)) !default;
    $input-height-lg: (($font-size-lg * $line-height-lg) + ($input-padding-y-lg * 2)) !default;
    $input-height-sm: (($font-size-sm * $line-height-sm) + ($input-padding-y-sm * 2)) !default;

    $form-group-margin-bottom: $spacer-y !default;

    $input-group-addon-bg: $gray-lighter !default;
    $input-group-addon-border-color: $input-border-color !default;

    $cursor-disabled: not-allowed !default;

    // Form validation icons
    $form-icon-success: "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2MTIgNzkyIj48cGF0aCBmaWxsPSIjNWNiODVjIiBkPSJNMjMzLjggNjEwYy0xMy4zIDAtMjYtNi0zNC0xNi44TDkwLjUgNDQ4LjhDNzYuMyA0MzAgODAgNDAzLjMgOTguOCAzODljMTguOC0xNC4yIDQ1LjUtMTAuNCA1OS44IDguNGw3MiA5NUw0NTEuMyAyNDJjMTIuNS0yMCAzOC44LTI2LjIgNTguOC0xMy43IDIwIDEyLjQgMjYgMzguNyAxMy43IDU4LjhMMjcwIDU5MGMtNy40IDEyLTIwLjIgMTkuNC0zNC4zIDIwaC0yeiIvPjwvc3ZnPg==" !default;
    $form-icon-warning: "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2MTIgNzkyIj48cGF0aCBmaWxsPSIjZjBhZDRlIiBkPSJNNjAzIDY0MC4ybC0yNzguNS01MDljLTMuOC02LjYtMTAuOC0xMC42LTE4LjUtMTAuNnMtMTQuNyA0LTE4LjUgMTAuNkw5IDY0MC4yYy0zLjcgNi41LTMuNiAxNC40LjIgMjAuOCAzLjggNi41IDEwLjggMTAuNCAxOC4zIDEwLjRoNTU3YzcuNiAwIDE0LjYtNCAxOC40LTEwLjQgMy41LTYuNCAzLjYtMTQuNCAwLTIwLjh6bS0yNjYuNC0zMGgtNjEuMlY1NDloNjEuMnY2MS4yem0wLTEwN2gtNjEuMlYzMDRoNjEuMnYxOTl6Ii8+PC9zdmc+" !default;
    $form-icon-danger: "data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCA2MTIgNzkyIj48cGF0aCBmaWxsPSIjZDk1MzRmIiBkPSJNNDQ3IDU0NC40Yy0xNC40IDE0LjQtMzcuNiAxNC40LTUyIDBsLTg5LTkyLjctODkgOTIuN2MtMTQuNSAxNC40LTM3LjcgMTQuNC01MiAwLTE0LjQtMTQuNC0xNC40LTM3LjYgMC01Mmw5Mi40LTk2LjMtOTIuNC05Ni4zYy0xNC40LTE0LjQtMTQuNC0zNy42IDAtNTJzMzcuNi0xNC4zIDUyIDBsODkgOTIuOCA4OS4yLTkyLjdjMTQuNC0xNC40IDM3LjYtMTQuNCA1MiAwIDE0LjMgMTQuNCAxNC4zIDM3LjYgMCA1MkwzNTQuNiAzOTZsOTIuNCA5Ni40YzE0LjQgMTQuNCAxNC40IDM3LjYgMCA1MnoiLz48L3N2Zz4=" !default;
*/
    // Dropdowns
    'dropdown-bg'           => '#ffffff',
    'dropdown-border-color' => 'rgba(0, 0, 0, .15)',
    'dropdown-border-width' => '1px',
    'dropdown-divider-bg'   => '#e5e5e5',

    'dropdown-link-color'       => '#353535',
    'dropdown-link-hover-color' => '#353535',
    'dropdown-link-hover-bg'    => '#f5f5f5',

    'dropdown-link-active-color' => '#ffffff',
    'dropdown-link-active-bg'    => '#61259e',

    'dropdown-link-disabled-color' => '#818a91',

    'dropdown-header-color' => '#818a91',
    /*
     * // Z-index master list
     * //
     * // Warning: Avoid customizing these values. They're used for a bird's eye view
     * // of components dependent on the z-axis and are designed to all work together.
     *
     * $zindex-navbar: 1000 !default;
     * $zindex-dropdown: 1000 !default;
     * $zindex-popover: 1060 !default;
     * $zindex-tooltip: 1070 !default;
     * $zindex-navbar-fixed: 1030 !default;
     * $zindex-navbar-sticky: 1030 !default;
     * $zindex-modal-bg: 1040 !default;
     * $zindex-modal: 1050 !default;
     *
     * // Navbar
     *
     * $navbar-border-radius: $border-radius !default;
     * $navbar-padding-horizontal: $spacer !default;
     * $navbar-padding-vertical: ($spacer / 2) !default;
     *
     * $navbar-dark-color: rgba(255, 255, 255, .5) !default;
     * $navbar-dark-hover-color: rgba(255, 255, 255, .75) !default;
     * $navbar-dark-active-color: rgba(255, 255, 255, 1) !default;
     * $navbar-dark-disabled-color: rgba(255, 255, 255, .25) !default;
     *
     * $navbar-light-color: rgba(0, 0, 0, .3) !default;
     * $navbar-light-hover-color: rgba(0, 0, 0, .6) !default;
     * $navbar-light-active-color: rgba(0, 0, 0, .8) !default;
     * $navbar-light-disabled-color: rgba(0, 0, 0, .15) !default;
     *
     * // Navs
     *
     * $nav-link-padding: .5em 1em !default;
     * $nav-link-hover-bg: $gray-lighter !default;
     *
     * $nav-disabled-link-color: $gray-light !default;
     * $nav-disabled-link-hover-color: $gray-light !default;
     *
     * $nav-tabs-border-color: #dddddd !default;
     *
     * $nav-tabs-link-border-width: $border-width !default;
     * $nav-tabs-link-hover-border-color: $gray-lighter !default;
     *
     * $nav-tabs-active-link-hover-bg: $body-bg !default;
     * $nav-tabs-active-link-hover-color: $gray !default;
     * $nav-tabs-active-link-hover-border-color: #dddddd !default;
     *
     * $nav-tabs-justified-link-border-color: #dddddd !default;
     * $nav-tabs-justified-active-link-border-color: $body-bg !default;
     *
     * $nav-pills-border-radius: $border-radius !default;
     * $nav-pills-active-link-hover-bg: $component-active-bg !default;
     * $nav-pills-active-link-hover-color: $component-active-color !default;
     *
     * // Pagination
     *
     * $pagination-padding-x: .75rem !default;
     * $pagination-padding-y: .5rem !default;
     * $pagination-padding-x-sm: .75rem !default;
     * $pagination-padding-y-sm: .275rem !default;
     * $pagination-padding-x-lg: 1.5rem !default;
     * $pagination-padding-y-lg: .75rem !default;
     *
     * $pagination-color: $link-color !default;
     * $pagination-bg: #ffffff !default;
     * $pagination-border-width: $border-width !default;
     * $pagination-border-color: #dddddd !default;
     *
     * $pagination-hover-color: $link-hover-color !default;
     * $pagination-hover-bg: $gray-lighter !default;
     * $pagination-hover-border: #dddddd !default;
     *
     * $pagination-active-color: #ffffff !default;
     * $pagination-active-bg: $brand-primary !default;
     * $pagination-active-border: $brand-primary !default;
     *
     * $pagination-disabled-color: $gray-light !default;
     * $pagination-disabled-bg: #ffffff !default;
     * $pagination-disabled-border: #dddddd !default;
     *
     * // Pager
     *
     * $pager-bg: $pagination-bg !default;
     * $pager-border-width: $border-width !default;
     * $pager-border-color: $pagination-border-color !default;
     * $pager-border-radius: 15px !default;
     *
     * $pager-hover-bg: $pagination-hover-bg !default;
     *
     * $pager-active-bg: $pagination-active-bg !default;
     * $pager-active-color: $pagination-active-color !default;
     *
     * $pager-disabled-color: $pagination-disabled-color !default;
     *
     * // Jumbotron
     *
     * $jumbotron-padding: 2rem !default;
     * $jumbotron-bg: #dee2e3 !default;
     *
     * // Form states and alerts
     * //
     * // Define colors for form feedback states and, by default, alerts.
     *
     * $state-success-text: #ffffff !default;
     * $state-success-bg: $brand-success !default;
     * $state-success-border: $state-success-bg !default;
     *
     * $state-info-text: #ffffff !default;
     * $state-info-bg: $brand-info !default;
     * $state-info-border: $state-info-bg !default;
     *
     * $state-warning-text: #ffffff !default;
     * $state-warning-bg: $brand-warning !default;
     * $state-warning-border: $state-warning-bg !default;
     *
     * $state-danger-text: #ffffff !default;
     * $state-danger-bg: $brand-danger !default;
     * $state-danger-border: $state-danger-bg !default;
     *
     * // Cards
     * $card-spacer-x: 1.25rem !default;
     * $card-spacer-y: .75rem !default;
     * $card-border-width: 1px !default;
     * $card-border-radius: $border-radius !default;
     * $card-border-color: #e5e5e5 !default;
     * $card-border-radius-inner: $card-border-radius !default;
     * $card-cap-bg: #f8f8f8 !default;
     * $card-bg: #ffffff !default;
     *
     * $card-link-hover-color: #ffffff !default;
     *
     * // Tooltips
     *
     * $tooltip-max-width: 200px !default;
     * $tooltip-color: #ffffff !default;
     * $tooltip-bg: #000000 !default;
     * $tooltip-opacity: .9 !default;
     *
     * $tooltip-arrow-width: 5px !default;
     * $tooltip-arrow-color: $tooltip-bg !default;
     *
     * // Popovers
     *
     * $popover-bg: #ffffff !default;
     * $popover-max-width: 276px !default;
     * $popover-border-width: $border-width !default;
     * $popover-border-color: rgba(0, 0, 0, .2) !default;
     *
     * $popover-title-bg: darken($popover-bg, 3 %) !default;
     *
     * $popover-arrow-width: 10px !default;
     * $popover-arrow-color: $popover-bg !default;
     *
     * $popover-arrow-outer-width: ($popover-arrow-width + 1) !default;
     * $popover-arrow-outer-color: fade-in($popover-border-color, 0.05) !default;
     *
     * // Labels
     *
     * $label -default-bg: $gray-light !default;
     * $label-primary-bg: $brand-primary !default;
     * $label-success-bg: $brand-success !default;
     * $label-info-bg: $brand-info !default;
     * $label-warning-bg: $brand-warning !default;
     * $label-danger-bg: $brand-danger !default;
     *
     * $label-color: #ffffff !default;
     * $label-link-hover-color: #ffffff !default;
     * $label-font-weight: bold !default;
     *
     * // Modals
     *
     * // Padding applied to the modal body
     * $modal-inner-padding: 15px !default;
     *
     * $modal-title-padding: 15px !default;
     * $modal-title-line-height: $line-height !default;
     *
     * $modal-content-bg: #ffffff !default;
     * $modal-content-border-color: rgba(0, 0, 0, .2) !default;
     *
     * $modal-backdrop-bg: #000000 !default;
     * $modal-backdrop-opacity: .5 !default;
     * $modal-header-border-color: #e5e5e5 !default;
     * $modal-footer-border-color: $modal-header-border-color !default;
     *
     * $modal-lg: 900px !default;
     * $modal-md: 600px !default;
     * $modal-sm: 300px !default;
     *
     * // Alerts
     * //
     * // Define alert colors, border radius, and padding.
     *
     * $alert-padding: 15px !default;
     * $alert-border-radius: $border-radius !default;
     * $alert-link-font-weight: bold !default;
     * $alert-border-width: $border-width !default;
     *
     * $alert-success-bg: $state-success-bg !default;
     * $alert-success-text: $state-success-text !default;
     * $alert-success-border: $state-success-border !default;
     *
     * $alert-info-bg: $state-info-bg !default;
     * $alert-info-text: $state-info-text !default;
     * $alert-info-border: $state-info-border !default;
     *
     * $alert-warning-bg: $state-warning-bg !default;
     * $alert-warning-text: $state-warning-text !default;
     * $alert-warning-border: $state-warning-border !default;
     *
     * $alert-danger-bg: $state-danger-bg !default;
     * $alert-danger-text: $state-danger-text !default;
     * $alert-danger-border: $state-danger-border !default;
     *
     * // Progress bars
     *
     * $progress-bg: #f5f5f5 !default;
     * $progress-bar-color: #ffffff !default;
     * $progress-border-radius: $border-radius !default;
     *
     * $progress-bar-bg: $brand-primary !default;
     * $progress-bar-success-bg: $brand-success !default;
     * $progress-bar-warning-bg: $brand-warning !default;
     * $progress-bar-danger-bg: $brand-danger !default;
     * $progress-bar-info-bg: $brand-info !default;
     *
     * // List group
     *
     * $list-group-bg: #ffffff !default;
     * $list-group-border-color: #dddddd !default;
     * $list-group-border-width: $border-width !default;
     * $list-group-border-radius: $border-radius !default;
     *
     * $list-group-hover-bg: #f5f5f5 !default;
     * $list-group-active-color: $component-active-color !default;
     * $list-group-active-bg: $component-active-bg !default;
     * $list-group-active-border: $list-group-active-bg !default;
     * $list-group-active-text-color: lighten($list-group-active-bg, 40 %) !default;
     *
     * $list-group-disabled-color: $gray-light !default;
     * $list-group-disabled-bg: $gray-lighter !default;
     * $list-group-disabled-text-color: $list-group-disabled-color !default;
     *
     * $list-group-link-color: #555555 !default;
     * $list-group-link-hover-color: $list-group-link-color !default;
     * $list-group-link-heading-color: #333333 !default;
     *
     * // Image thumbnails
     *
     * $thumbnail-padding: .25rem !default;
     * $thumbnail-bg: $body-bg !default;
     * $thumbnail-border-width: $border-width !default;
     * $thumbnail-border-color: #dddddd !default;
     * $thumbnail-border-radius: $border-radius !default;
     *
     * // Breadcrumbs
     *
     * $breadcrumb-padding-vertical: .75rem !default;
     * $breadcrumb-padding-horizontal: 1rem !default;
     *
     * $breadcrumb-bg: transparent !default;
     * $breadcrumb-divider-color: $gray-light !default;
     * $breadcrumb-active-color: $brand-info !default;
     * $breadcrumb-divider: "›" !default;
     *
     * // Carousel
     *
     * $carousel-text-shadow: 0 1px 2px rgba(0, 0, 0, .6) !default;
     *
     * $carousel-control-color: #ffffff !default;
     * $carousel-control-width: 15 % !default;
     * $carousel-control-opacity: .5 !default;
     * $carousel-control-font-size: 20px !default;
     *
     * $carousel-indicator-active-bg: #ffffff !default;
     * $carousel-indicator-border-color: #ffffff !default;
     *
     * $carousel-caption-color: #ffffff !default;
     *
     * // Close
     *
     * $close-font-weight: bold !default;
     * $close-color: #000000 !default;
     * $close-text-shadow: 0 1px 0 #ffffff !default;
     *
     * // Code
     *
     * $code-color: #bd4147 !default;
     * $code-bg: #f7f7f9 !default;
     *
     * $kbd-color: #ffffff !default;
     * $kbd-bg: #333333 !default;
     *
     * $pre-bg: #f7f7f9 !default;
     * $pre-color: $gray-dark !default;
     * $pre-border-color: #cccccc !default;
     * $pre-scrollable-max-height: 340px !default;*/

];
