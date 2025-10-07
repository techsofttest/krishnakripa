<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Backup extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->dbutil();
        $this->load->helper(['file', 'download']);
    }

    /**
     * Generate database backup.
     * CLI  -> creates backup file (silent mode)
     * HTTP -> triggers backup + sends file to browser
     */
    public function daily()
    {
        // Common backup preferences
        $prefs = [
            'format'   => 'zip',
            'filename' => 'backup_' . date('Y-m-d_H-i-s') . '.sql'
        ];

        $backup = $this->dbutil->backup($prefs);
        $db_name = 'krishnakripa-backup-on-' . date('Y-m-d_H-i-s') . '.zip';
        $save_path = 'backups/'; // outside public_html for safety

        // Ensure folder exists
        if (!is_dir($save_path)) {
            mkdir($save_path, 0755, true);
        }

        $file_path = $save_path . $db_name;
        write_file($file_path, $backup);

        // Clean up old files (7 days)
        
        $files = glob($save_path . '*.zip');
        $expire_time = time() - (7 * 24 * 60 * 60);
        foreach ($files as $file) {
            if (filemtime($file) < $expire_time) unlink($file);
        }

        // CLI mode → silent save
        if ($this->input->is_cli_request()) {
            echo "Backup created: $file_path\n";
            return;
        }

        // HTTP mode → download the generated file
        if (file_exists($file_path)) {
            // Force download through browser
            force_download($db_name, $backup);
        } else {
            show_error('Backup file not found.', 404);
        }
    }
}