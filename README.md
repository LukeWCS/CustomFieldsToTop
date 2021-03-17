## Custom Fields To Top - MantisBT plugin
Moves selected custom fields to the top of the Report Issue form and the Update Issue form. For both forms it can be specified separately which user-defined fields should be positioned at the top of the form and also in which order. This gives you the freedom to place user-defined fields both at the bottom (Mantis standard) and at the top of the form.

### Additional information on the technical side of the plugin:
* Required Mantis version: 2.25.0+
* The plugin is designed in such a way that the JS / jQuery script is only loaded where it is needed, i.e. only for the two forms.
* The JS / jQuery script is isolated as far as the variables are concerned. No variables / functions are defined in the global namespace.

### Installation

1. Download the latest release archive.
2. Copy the folder `CustomFieldsToTop` from the archive into the plugin folder `plugins` of Mantis.
3. Navigate to the plugin management in Mantis: **Manage** > **Manage Plugins**.
4. Install the **Custom Fields To Top** plugin with the **Install** button.
5. The configuration can be opened by clicking on the title **Custom Fields To Top**. 
