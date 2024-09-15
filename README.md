# FCC Broadband Consumer Labels

## Description

The FCC Broadband Consumer Labels plugin is a powerful WordPress tool designed to create and manage FCC Broadband Consumer Labels. It provides comprehensive data entry forms, company configurations, and shortcode generation for easy display of labels in posts and pages.

This plugin allows Internet Service Providers (ISPs) to comply with the FCC's requirements for displaying broadband service information in a standardized format, making it easier for consumers to compare different broadband offerings.


## Features

- Create and manage multiple broadband labels
- Configure company information
- Generate shortcodes for easy label insertion in posts and pages
- Responsive label design that adheres to FCC guidelines
- Admin interface for easy label management
- Live preview of labels during creation and editing
- Support for both fixed and mobile broadband services
- Customizable fees, speeds, and pricing information


## Installation

1. Upload the `fcc-broadband-consumer-labels` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Navigate to the 'FCC Labels' menu in your WordPress admin panel to start creating labels


## Usage

### Creating a New Label

1. In your WordPress admin panel, go to 'FCC Labels' > 'Add New Label'
2. Fill out the form with your broadband service details
3. Click 'Add Label' to save the new label


### Managing Labels

1. Go to 'FCC Labels' > 'Manage Labels'
2. Here you can view all created labels, edit existing labels, or delete labels


### Displaying Labels on Your Site

To display a label on your website, use the shortcode provided in the 'Manage Labels' section. For example:

[fcc_bcl id="1"]

Replace "1" with the ID of the label you want to display.


### Company Configuration

1. Go to 'FCC Labels' > 'Company Configuration'
2. Add your company details
3. These details will be available when creating new labels


## Customization

The plugin uses CSS for styling the labels. You can customize the appearance by modifying the following files:

- `public/css/fcc-bcl-label.css`
- `public/css/fcc-bcl-admin.css`


## Frequently Asked Questions

**Q: Can I create multiple labels for different service plans?**
A: Yes, you can create as many labels as you need for different service plans or offerings.

**Q: Is this plugin compatible with the latest WordPress version?**
A: Yes, the plugin is regularly updated to ensure compatibility with the latest WordPress version.

**Q: Can I customize the appearance of the labels?**
A: Yes, you can customize the appearance by modifying the CSS files included in the plugin.


## Support

For support, please use one of the following methods:

1. Create an issue on our [GitHub issue tracker](https://github.com/Stoopler/fcc-data-labels/issues). This is the preferred method for reporting bugs, requesting features, or asking questions about the plugin's functionality.

2. Contact the plugin author directly for urgent or sensitive matters.

When creating an issue on GitHub, please provide as much detail as possible, including your WordPress version, plugin version, and steps to reproduce any problems you're experiencing.


## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.


## License

This plugin is licensed under the GNU General Public License v3.0 or later. See the LICENSE file for details.


## Changelog

### 1.1.4
- Added support for multiple companies
- Improved label preview functionality
- Fixed minor bugs in data processing

### 1.0.0
- Initial release


## Credits

This plugin was developed by Tyler Weinrich.


## TODO

- Implement data export functionality
- Add support for multi-language labels
- Enhance mobile responsiveness of labels