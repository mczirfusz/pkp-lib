<?php

/**
 * @file controllers/grid/files/productionReady/ProductionReadyFilesGridHandler.inc.php
 *
 * Copyright (c) 2014-2015 Simon Fraser University Library
 * Copyright (c) 2003-2015 John Willinsky
 * Distributed under the GNU GPL v2. For full terms see the file docs/COPYING.
 *
 * @class ProductionReadyFilesGridHandler
 * @ingroup controllers_grid_files_productionready
 *
 * @brief Handle the fair copy files grid (displays copyedited files ready to move to proofreading)
 */

import('lib.pkp.controllers.grid.files.fileList.FileListGridHandler');

class ProductionReadyFilesGridHandler extends FileListGridHandler {
	/**
	 * Constructor
	 */
	function ProductionReadyFilesGridHandler() {
		import('lib.pkp.controllers.grid.files.SubmissionFilesGridDataProvider');
		parent::FileListGridHandler(
			new SubmissionFilesGridDataProvider(SUBMISSION_FILE_PRODUCTION_READY),
			WORKFLOW_STAGE_ID_PRODUCTION,
			FILE_GRID_ADD|FILE_GRID_DELETE|FILE_GRID_VIEW_NOTES|FILE_GRID_EDIT
		);

		$this->addRoleAssignment(
			array(
				ROLE_ID_SUB_EDITOR,
				ROLE_ID_MANAGER,
				ROLE_ID_ASSISTANT
			),
			array(
				'fetchGrid', 'fetchRow',
				'addFile',
				'downloadFile',
				'deleteFile',
				'signOffFile'
			)
		);
	}

	/**
	 * @copydoc PKPHandler::initialize()
	 */
	function initialize($request) {
		parent::initialize($request);

		$this->setTitle('editor.submission.production.productionReadyFiles');
		$this->setInstructions('editor.submission.production.productionReadyFilesDescription');
	}
}

?>
