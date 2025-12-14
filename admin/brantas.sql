/*
Source Server         : localhost_3306
Source Server Type    : MySQL
Source Server Version : 100139 (10.1.39-MariaDB)
Source Host           : localhost:3306
Source Schema         : btrantas
Target Server Type    : MySQL
Target Server Version : 100139 (10.1.39-MariaDB)
File Encoding         : 65001
Date: 01/10/2024 09:47:32
*/

SET NAMES utf8mb4;

SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for backup_log
-- ----------------------------
DROP TABLE IF EXISTS `backup_log`;

CREATE TABLE `backup_log` (
    `backup_log_id` int NOT NULL AUTO_INCREMENT,
    `user_id` int NOT NULL DEFAULT 0,
    `backup_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `backup_file` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    PRIMARY KEY (`backup_log_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of backup_log
-- ----------------------------

-- ----------------------------
-- Table structure for biblio
-- ----------------------------
DROP TABLE IF EXISTS `biblio`;

CREATE TABLE `biblio` (
    `biblio_id` int NOT NULL AUTO_INCREMENT,
    `unique_id` int NOT NULL,
    `gmd_id` int NULL DEFAULT NULL,
    `item_type_id` int NULL DEFAULT NULL,
    `title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `sor` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `edition` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `student_id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `cp_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `departement` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `code_ministry` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `isbn_issn` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `publisher_id` int NULL DEFAULT NULL,
    `publish_year` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `collation` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `series_title` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `call_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `language_id` char(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'en',
    `copyright_id` int NULL DEFAULT NULL,
    `license_id` int NOT NULL,
    `source` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `publish_place_id` int NULL DEFAULT NULL,
    `classification` varchar(40) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `file_att` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `url_crossref` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `opac_hide` smallint NULL DEFAULT 0,
    `promoted` smallint NULL DEFAULT 0,
    `labels` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `frequency_id` int NOT NULL DEFAULT 0,
    `spec_detail_info` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `input_date` datetime NULL DEFAULT NULL,
    `last_update` datetime NULL DEFAULT NULL,
    `uid` int NULL DEFAULT NULL,
    `step` smallint NOT NULL DEFAULT 1,
    PRIMARY KEY (`biblio_id`) USING BTREE,
    INDEX `references_idx` (
        `gmd_id`,
        `publisher_id`,
        `language_id`,
        `publish_place_id`
    ) USING BTREE,
    INDEX `classification` (`classification`) USING BTREE,
    INDEX `biblio_flag_idx` (`opac_hide`, `promoted`) USING BTREE,
    INDEX `uid` (`uid`) USING BTREE,
    FULLTEXT INDEX `title_ft_idx` (`title`, `series_title`),
    FULLTEXT INDEX `notes_ft_idx` (`notes`),
    FULLTEXT INDEX `labels` (`labels`)
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of biblio
-- ----------------------------

-- ----------------------------
-- Table structure for biblio_attachment
-- ----------------------------
DROP TABLE IF EXISTS `biblio_attachment`;

CREATE TABLE `biblio_attachment` (
    `biblio_id` int NOT NULL,
    `file_id` int NOT NULL,
    `access_type` enum('public', 'private') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `access_limit` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    INDEX `biblio_id` (`biblio_id`) USING BTREE,
    INDEX `file_id` (`file_id`) USING BTREE,
    INDEX `biblio_id_2` (`biblio_id`, `file_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of biblio_attachment
-- ----------------------------

-- ----------------------------
-- Table structure for biblio_author
-- ----------------------------
DROP TABLE IF EXISTS `biblio_author`;

CREATE TABLE `biblio_author` (
    `biblio_id` int NOT NULL DEFAULT 0,
    `author_id` int NOT NULL DEFAULT 0,
    `level` int NOT NULL DEFAULT 1,
    PRIMARY KEY (`biblio_id`, `author_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of biblio_author
-- ----------------------------

-- ----------------------------
-- Table structure for biblio_contributor
-- ----------------------------
DROP TABLE IF EXISTS `biblio_contributor`;

CREATE TABLE `biblio_contributor` (
    `biblio_id` int NOT NULL,
    `contributor_id` int NOT NULL,
    `level` int NOT NULL,
    PRIMARY KEY (`biblio_id`, `contributor_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of biblio_contributor
-- ----------------------------

-- ----------------------------
-- Table structure for biblio_custom
-- ----------------------------
DROP TABLE IF EXISTS `biblio_custom`;

CREATE TABLE `biblio_custom` (
    `biblio_id` int NOT NULL,
    PRIMARY KEY (`biblio_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'one to one relation with real biblio table' ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of biblio_custom
-- ----------------------------

-- ----------------------------
-- Table structure for biblio_examiner
-- ----------------------------
DROP TABLE IF EXISTS `biblio_examiner`;

CREATE TABLE `biblio_examiner` (
    `biblio_id` int NOT NULL DEFAULT 0,
    `examiner_id` int NOT NULL DEFAULT 0,
    `level` int NOT NULL DEFAULT 1,
    PRIMARY KEY (`biblio_id`, `examiner_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of biblio_examiner
-- ----------------------------

-- ----------------------------
-- Table structure for biblio_supervisor
-- ----------------------------
DROP TABLE IF EXISTS `biblio_supervisor`;

CREATE TABLE `biblio_supervisor` (
    `biblio_id` int NOT NULL DEFAULT 0,
    `supervisor_id` int NOT NULL DEFAULT 0,
    `level` int NOT NULL DEFAULT 1,
    PRIMARY KEY (`biblio_id`, `supervisor_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of biblio_supervisor
-- ----------------------------

-- ----------------------------
-- Table structure for biblio_topic
-- ----------------------------
DROP TABLE IF EXISTS `biblio_topic`;

CREATE TABLE `biblio_topic` (
    `biblio_id` int NOT NULL DEFAULT 0,
    `topic_id` int NOT NULL DEFAULT 0,
    `level` int NOT NULL DEFAULT 1,
    PRIMARY KEY (`biblio_id`, `topic_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of biblio_topic
-- ----------------------------

-- ----------------------------
-- Table structure for comment
-- ----------------------------
DROP TABLE IF EXISTS `comment`;

CREATE TABLE `comment` (
    `comment_id` int NOT NULL AUTO_INCREMENT,
    `biblio_id` int NOT NULL,
    `member_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `comment` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `input_date` datetime NULL DEFAULT NULL,
    `last_update` datetime NULL DEFAULT NULL,
    PRIMARY KEY (`comment_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of comment
-- ----------------------------

-- ----------------------------
-- Table structure for content
-- ----------------------------
DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
    `content_id` int NOT NULL AUTO_INCREMENT,
    `content_title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `content_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `content_path` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `input_date` datetime NOT NULL,
    `last_update` datetime NOT NULL,
    `content_ownpage` enum('1', '2') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
    PRIMARY KEY (`content_id`) USING BTREE,
    UNIQUE INDEX `content_path` (`content_path`) USING BTREE,
    FULLTEXT INDEX `content_title` (`content_title`),
    FULLTEXT INDEX `content_desc` (`content_desc`)
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of content
-- ----------------------------

-- ----------------------------
-- Table structure for files
-- ----------------------------
DROP TABLE IF EXISTS `files`;

CREATE TABLE `files` (
    `file_id` int NOT NULL AUTO_INCREMENT,
    `file_title` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `file_name` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `file_url` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `file_dir` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `mime_type` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `file_desc` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `uploader_id` int NOT NULL,
    `input_date` datetime NOT NULL,
    `last_update` datetime NOT NULL,
    PRIMARY KEY (`file_id`) USING BTREE,
    FULLTEXT INDEX `file_name` (`file_name`),
    FULLTEXT INDEX `file_dir` (`file_dir`)
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of files
-- ----------------------------

-- ----------------------------
-- Table structure for fines
-- ----------------------------
DROP TABLE IF EXISTS `fines`;

CREATE TABLE `fines` (
    `fines_id` int NOT NULL AUTO_INCREMENT,
    `fines_date` date NOT NULL,
    `member_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `debet` int NULL DEFAULT 0,
    `credit` int NULL DEFAULT 0,
    `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    PRIMARY KEY (`fines_id`) USING BTREE,
    INDEX `member_id` (`member_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of fines
-- ----------------------------

-- ----------------------------
-- Table structure for group_access
-- ----------------------------
DROP TABLE IF EXISTS `group_access`;

CREATE TABLE `group_access` (
    `group_id` int NOT NULL,
    `module_id` int NOT NULL,
    `r` int NOT NULL DEFAULT 0,
    `w` int NOT NULL DEFAULT 0,
    PRIMARY KEY (`group_id`, `module_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of group_access
-- ----------------------------
INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (1, 5, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (1, 2, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (1, 1, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (1, 18, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (1, 48, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (1, 36, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (1, 9, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (1, 4, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (2, 5, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (2, 48, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (2, 4, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (2, 9, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (2, 36, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (3, 5, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (3, 4, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (4, 5, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (6, 4, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (6, 36, 0, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (6, 9, 1, 0);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (6, 18, 1, 0);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (6, 48, 1, 0);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (6, 62, 1, 0);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (6, 5, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (7, 18, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (7, 48, 0, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (7, 9, 1, 1);

INSERT INTO
    group_access (
        `group_id`,
        `module_id`,
        `r`,
        `w`
    )
VALUES (7, 62, 0, 1);

-- ----------------------------
-- Table structure for holiday
-- ----------------------------
DROP TABLE IF EXISTS `holiday`;

CREATE TABLE `holiday` (
    `holiday_id` int NOT NULL AUTO_INCREMENT,
    `holiday_dayname` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `holiday_date` date NULL DEFAULT NULL,
    `description` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    PRIMARY KEY (`holiday_id`) USING BTREE,
    UNIQUE INDEX `holiday_dayname` (
        `holiday_dayname`,
        `holiday_date`
    ) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of holiday
-- ----------------------------

-- ----------------------------
-- Table structure for item
-- ----------------------------
DROP TABLE IF EXISTS `item`;

CREATE TABLE `item` (
    `item_id` int NOT NULL AUTO_INCREMENT,
    `biblio_id` int NULL DEFAULT NULL,
    `call_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `coll_type_id` int NULL DEFAULT NULL,
    `item_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `inventory_code` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `received_date` date NULL DEFAULT NULL,
    `supplier_id` varchar(6) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `order_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `location_id` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `order_date` date NULL DEFAULT NULL,
    `item_status_id` char(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `site` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `source` int NOT NULL DEFAULT 0,
    `invoice` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `price` int NULL DEFAULT NULL,
    `price_currency` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `invoice_date` date NULL DEFAULT NULL,
    `input_date` datetime NOT NULL,
    `last_update` datetime NULL DEFAULT NULL,
    `uid` int NULL DEFAULT NULL,
    PRIMARY KEY (`item_id`) USING BTREE,
    UNIQUE INDEX `item_code` (`item_code`) USING BTREE,
    INDEX `item_references_idx` (
        `coll_type_id`,
        `location_id`,
        `item_status_id`
    ) USING BTREE,
    INDEX `uid` (`uid`) USING BTREE,
    INDEX `biblio_id_idx` (`biblio_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of item
-- ----------------------------

-- ----------------------------
-- Table structure for kardex
-- ----------------------------
DROP TABLE IF EXISTS `kardex`;

CREATE TABLE `kardex` (
    `kardex_id` int NOT NULL AUTO_INCREMENT,
    `date_expected` date NOT NULL,
    `date_received` date NULL DEFAULT NULL,
    `seq_number` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `serial_id` int NULL DEFAULT NULL,
    `input_date` date NOT NULL,
    `last_update` date NOT NULL,
    PRIMARY KEY (`kardex_id`) USING BTREE,
    INDEX `fk_serial` (`serial_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kardex
-- ----------------------------

-- ----------------------------
-- Table structure for loan
-- ----------------------------
DROP TABLE IF EXISTS `loan`;

CREATE TABLE `loan` (
    `loan_id` int NOT NULL AUTO_INCREMENT,
    `item_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `member_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `loan_date` date NOT NULL,
    `due_date` date NOT NULL,
    `renewed` int NOT NULL DEFAULT 0,
    `loan_rules_id` int NOT NULL DEFAULT 0,
    `actual` date NULL DEFAULT NULL,
    `is_lent` int NOT NULL DEFAULT 0,
    `is_return` int NOT NULL DEFAULT 0,
    `return_date` date NULL DEFAULT NULL,
    PRIMARY KEY (`loan_id`) USING BTREE,
    INDEX `item_code` (`item_code`) USING BTREE,
    INDEX `member_id` (`member_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of loan
-- ----------------------------

-- ----------------------------
-- Table structure for long_pattern
-- ----------------------------
DROP TABLE IF EXISTS `long_pattern`;

CREATE TABLE `long_pattern` (
    `pattern_id` int NOT NULL AUTO_INCREMENT,
    `pattern_prefix` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
    `pattern_zero` int NULL DEFAULT NULL,
    `pattern_suffix` varchar(5) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
    `input_date` date NULL DEFAULT NULL,
    `last_update` datetime NULL DEFAULT NULL,
    PRIMARY KEY (`pattern_id`) USING BTREE,
    UNIQUE INDEX `pattern_prefix` (
        `pattern_prefix`,
        `pattern_suffix`
    ) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of long_pattern
-- ----------------------------

-- ----------------------------
-- Table structure for member
-- ----------------------------
DROP TABLE IF EXISTS `member`;

CREATE TABLE `member` (
    `member_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `member_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `gender` int NOT NULL,
    `birth_date` date NULL DEFAULT NULL,
    `member_type_id` int NULL DEFAULT NULL,
    `member_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `member_mail_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `member_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `postal_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `inst_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `is_new` int NULL DEFAULT NULL,
    `member_image` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `pin` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `member_phone` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `member_fax` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `member_since_date` date NULL DEFAULT NULL,
    `register_date` date NULL DEFAULT NULL,
    `expire_date` date NOT NULL,
    `member_notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `is_pending` smallint NOT NULL DEFAULT 0,
    `mpasswd` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `last_login` datetime NULL DEFAULT NULL,
    `last_login_ip` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `input_date` date NULL DEFAULT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`member_id`) USING BTREE,
    INDEX `member_name` (`member_name`) USING BTREE,
    INDEX `member_type_id` (`member_type_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of member
-- ----------------------------

-- ----------------------------
-- Table structure for member_custom
-- ----------------------------
DROP TABLE IF EXISTS `member_custom`;

CREATE TABLE `member_custom` (
    `member_id` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
    PRIMARY KEY (`member_id`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = latin1 COLLATE = latin1_swedish_ci COMMENT = 'one to one relation with real member table' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of member_custom
-- ----------------------------

-- ----------------------------
-- Table structure for mst_author
-- ----------------------------
DROP TABLE IF EXISTS `mst_author`;

CREATE TABLE `mst_author` (
    `author_id` int NOT NULL AUTO_INCREMENT,
    `author_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `author_year` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `authority_type` enum('p', 'o', 'c') CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'p',
    `auth_list` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `input_date` date NOT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`author_id`) USING BTREE,
    UNIQUE INDEX `author_name` (
        `author_name`,
        `authority_type`
    ) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mst_author
-- ----------------------------

-- ----------------------------
-- Table structure for mst_code_ministry
-- ----------------------------
DROP TABLE IF EXISTS `mst_code_ministry`;

CREATE TABLE `mst_code_ministry` (
    `code_ministry` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `name_prodi` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `degree` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `university` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `input_date` date NOT NULL,
    `last_update` date NOT NULL,
    PRIMARY KEY (`code_ministry`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of mst_code_ministry
-- ----------------------------

-- ----------------------------
-- Table structure for mst_coll_type
-- ----------------------------
DROP TABLE IF EXISTS `mst_coll_type`;

CREATE TABLE `mst_coll_type` (
    `coll_type_id` int NOT NULL AUTO_INCREMENT,
    `coll_type_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `input_date` date NULL DEFAULT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`coll_type_id`) USING BTREE,
    UNIQUE INDEX `coll_type_name` (`coll_type_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mst_coll_type
-- ----------------------------

-- ----------------------------
-- Table structure for mst_contributor
-- ----------------------------
DROP TABLE IF EXISTS `mst_contributor`;

CREATE TABLE `mst_contributor` (
    `contributor_id` int NOT NULL AUTO_INCREMENT,
    `contributor_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `contributor_type` enum('p', 'o', 'c') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `input_date` date NOT NULL,
    `last_update` date NOT NULL,
    PRIMARY KEY (`contributor_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of mst_contributor
-- ----------------------------

-- ----------------------------
-- Table structure for mst_copyright
-- ----------------------------
DROP TABLE IF EXISTS `mst_copyright`;

CREATE TABLE `mst_copyright` (
    `copyright_id` int NOT NULL AUTO_INCREMENT,
    `copyright_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `input_date` date NOT NULL,
    `last_update` date NOT NULL,
    PRIMARY KEY (`copyright_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of mst_copyright
-- ----------------------------

-- ----------------------------
-- Table structure for mst_examiner
-- ----------------------------
DROP TABLE IF EXISTS `mst_examiner`;

CREATE TABLE `mst_examiner` (
    `examiner_id` int NOT NULL AUTO_INCREMENT,
    `examiner_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `examiner_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `examiner_type` enum('p', 'o', 'c') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `input_date` date NOT NULL,
    `last_update` date NOT NULL,
    PRIMARY KEY (`examiner_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of mst_examiner
-- ----------------------------

-- ----------------------------
-- Table structure for mst_frequency
-- ----------------------------
DROP TABLE IF EXISTS `mst_frequency`;

CREATE TABLE `mst_frequency` (
    `frequency_id` int NOT NULL AUTO_INCREMENT,
    `frequency` varchar(25) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `language_prefix` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `time_increment` smallint NULL DEFAULT NULL,
    `time_unit` enum(
        'day',
        'week',
        'month',
        'year'
    ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'day',
    `input_date` date NOT NULL,
    `last_update` date NOT NULL,
    PRIMARY KEY (`frequency_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mst_frequency
-- ----------------------------

-- ----------------------------
-- Table structure for mst_gmd
-- ----------------------------
DROP TABLE IF EXISTS `mst_gmd`;

CREATE TABLE `mst_gmd` (
    `gmd_id` int NOT NULL AUTO_INCREMENT,
    `gmd_code` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `gmd_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `icon_image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `input_date` date NOT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`gmd_id`) USING BTREE,
    UNIQUE INDEX `gmd_name` (`gmd_name`) USING BTREE,
    UNIQUE INDEX `gmd_code` (`gmd_code`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mst_gmd
-- ----------------------------

-- ----------------------------
-- Table structure for mst_icon
-- ----------------------------
DROP TABLE IF EXISTS `mst_icon`;

CREATE TABLE `mst_icon` (
    `id` int NOT NULL AUTO_INCREMENT,
    `class_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `icon_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 620 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of mst_icon
-- ----------------------------
INSERT INTO `mst_icon` VALUES ( 1, 'fa-adjust', 'fa fa-adjust' );

INSERT INTO `mst_icon` VALUES ( 2, 'fa-anchor', 'fa fa-anchor' );

INSERT INTO `mst_icon` VALUES ( 3, 'fa-archive', 'fa fa-archive' );

INSERT INTO
    `mst_icon`
VALUES (
        4,
        'fa-area-chart',
        'fa fa-area-chart'
    );

INSERT INTO `mst_icon` VALUES ( 5, 'fa-arrows', 'fa fa-arrows' );

INSERT INTO `mst_icon` VALUES ( 6, 'fa-arrows-h', 'fa fa-arrows-h' );

INSERT INTO `mst_icon` VALUES ( 7, 'fa-arrows-v', 'fa fa-arrows-v' );

INSERT INTO `mst_icon` VALUES ( 8, 'fa-asterisk', 'fa fa-asterisk' );

INSERT INTO `mst_icon` VALUES (9, 'fa-at', 'fa fa-at');

INSERT INTO
    `mst_icon`
VALUES (
        10,
        'fa-automobile',
        'fa fa-automobile'
    );

INSERT INTO `mst_icon` VALUES (11, 'fa-ban', 'fa fa-ban');

INSERT INTO `mst_icon` VALUES (12, 'fa-bank', 'fa fa-bank');

INSERT INTO
    `mst_icon`
VALUES (
        13,
        'fa-bar-chart',
        'fa fa-bar-chart'
    );

INSERT INTO
    `mst_icon`
VALUES (
        14,
        'fa-bar-chart-o',
        'fa fa-bar-chart-o'
    );

INSERT INTO `mst_icon` VALUES ( 15, 'fa-barcode', 'fa fa-barcode' );

INSERT INTO `mst_icon` VALUES (16, 'fa-bars', 'fa fa-bars');

INSERT INTO `mst_icon` VALUES (17, 'fa-beer', 'fa fa-beer');

INSERT INTO `mst_icon` VALUES (18, 'fa-bell', 'fa fa-bell');

INSERT INTO `mst_icon` VALUES ( 19, 'fa-bell-o', 'fa fa-bell-o' );

INSERT INTO
    `mst_icon`
VALUES (
        20,
        'fa-bell-slash',
        'fa fa-bell-slash'
    );

INSERT INTO
    `mst_icon`
VALUES (
        21,
        'fa-bell-slash-o',
        'fa fa-bell-slash-o'
    );

INSERT INTO `mst_icon` VALUES ( 22, 'fa-bicycle', 'fa fa-bicycle' );

INSERT INTO
    `mst_icon`
VALUES (
        23,
        'fa-binoculars',
        'fa fa-binoculars'
    );

INSERT INTO
    `mst_icon`
VALUES (
        24,
        'fa-birthday-cake',
        'fa fa-birthday-cake'
    );

INSERT INTO `mst_icon` VALUES (25, 'fa-bolt', 'fa fa-bolt');

INSERT INTO `mst_icon` VALUES (26, 'fa-bomb', 'fa fa-bomb');

INSERT INTO `mst_icon` VALUES (27, 'fa-book', 'fa fa-book');

INSERT INTO
    `mst_icon`
VALUES (
        28,
        'fa-bookmark',
        'fa fa-bookmark'
    );

INSERT INTO
    `mst_icon`
VALUES (
        29,
        'fa-bookmark-o',
        'fa fa-bookmark-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        30,
        'fa-briefcase',
        'fa fa-briefcase'
    );

INSERT INTO `mst_icon` VALUES (31, 'fa-bug', 'fa fa-bug');

INSERT INTO
    `mst_icon`
VALUES (
        32,
        'fa-building',
        'fa fa-building'
    );

INSERT INTO
    `mst_icon`
VALUES (
        33,
        'fa-building-o',
        'fa fa-building-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        34,
        'fa-bullhorn',
        'fa fa-bullhorn'
    );

INSERT INTO
    `mst_icon`
VALUES (
        35,
        'fa-bullseye',
        'fa fa-bullseye'
    );

INSERT INTO `mst_icon` VALUES (36, 'fa-bus', 'fa fa-bus');

INSERT INTO `mst_icon` VALUES (37, 'fa-cab', 'fa fa-cab');

INSERT INTO
    `mst_icon`
VALUES (
        38,
        'fa-calculator',
        'fa fa-calculator'
    );

INSERT INTO
    `mst_icon`
VALUES (
        39,
        'fa-calendar',
        'fa fa-calendar'
    );

INSERT INTO
    `mst_icon`
VALUES (
        40,
        'fa-calendar-o',
        'fa fa-calendar-o'
    );

INSERT INTO `mst_icon` VALUES ( 41, 'fa-camera', 'fa fa-camera' );

INSERT INTO
    `mst_icon`
VALUES (
        42,
        'fa-camera-retro',
        'fa fa-camera-retro'
    );

INSERT INTO `mst_icon` VALUES (43, 'fa-car', 'fa fa-car');

INSERT INTO
    `mst_icon`
VALUES (
        44,
        'fa-caret-square-o-down',
        'fa fa-caret-square-o-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        45,
        'fa-caret-square-o-left',
        'fa fa-caret-square-o-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        46,
        'fa-caret-square-o-right',
        'fa fa-caret-square-o-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        47,
        'fa-caret-square-o-up',
        'fa fa-caret-square-o-up'
    );

INSERT INTO `mst_icon` VALUES (48, 'fa-cc', 'fa fa-cc');

INSERT INTO
    `mst_icon`
VALUES (
        49,
        'fa-certificate',
        'fa fa-certificate'
    );

INSERT INTO `mst_icon` VALUES (50, 'fa-check', 'fa fa-check');

INSERT INTO
    `mst_icon`
VALUES (
        51,
        'fa-check-circle',
        'fa fa-check-circle'
    );

INSERT INTO
    `mst_icon`
VALUES (
        52,
        'fa-check-circle-o',
        'fa fa-check-circle-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        53,
        'fa-check-square',
        'fa fa-check-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        54,
        'fa-check-square-o',
        'fa fa-check-square-o'
    );

INSERT INTO `mst_icon` VALUES (55, 'fa-child', 'fa fa-child');

INSERT INTO `mst_icon` VALUES ( 56, 'fa-circle', 'fa fa-circle' );

INSERT INTO
    `mst_icon`
VALUES (
        57,
        'fa-circle-o',
        'fa fa-circle-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        58,
        'fa-circle-o-notch',
        'fa fa-circle-o-notch'
    );

INSERT INTO
    `mst_icon`
VALUES (
        59,
        'fa-circle-thin',
        'fa fa-circle-thin'
    );

INSERT INTO `mst_icon` VALUES ( 60, 'fa-clock-o', 'fa fa-clock-o' );

INSERT INTO `mst_icon` VALUES (61, 'fa-close', 'fa fa-close');

INSERT INTO `mst_icon` VALUES (62, 'fa-cloud', 'fa fa-cloud');

INSERT INTO
    `mst_icon`
VALUES (
        63,
        'fa-cloud-download',
        'fa fa-cloud-download'
    );

INSERT INTO
    `mst_icon`
VALUES (
        64,
        'fa-cloud-upload',
        'fa fa-cloud-upload'
    );

INSERT INTO `mst_icon` VALUES (65, 'fa-code', 'fa fa-code');

INSERT INTO
    `mst_icon`
VALUES (
        66,
        'fa-code-fork',
        'fa fa-code-fork'
    );

INSERT INTO `mst_icon` VALUES ( 67, 'fa-coffee', 'fa fa-coffee' );

INSERT INTO `mst_icon` VALUES (68, 'fa-cog', 'fa fa-cog');

INSERT INTO `mst_icon` VALUES (69, 'fa-cogs', 'fa fa-cogs');

INSERT INTO `mst_icon` VALUES ( 70, 'fa-comment', 'fa fa-comment' );

INSERT INTO
    `mst_icon`
VALUES (
        71,
        'fa-comment-o',
        'fa fa-comment-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        72,
        'fa-comments',
        'fa fa-comments'
    );

INSERT INTO
    `mst_icon`
VALUES (
        73,
        'fa-comments-o',
        'fa fa-comments-o'
    );

INSERT INTO `mst_icon` VALUES ( 74, 'fa-compass', 'fa fa-compass' );

INSERT INTO
    `mst_icon`
VALUES (
        75,
        'fa-copyright',
        'fa fa-copyright'
    );

INSERT INTO
    `mst_icon`
VALUES (
        76,
        'fa-credit-card',
        'fa fa-credit-card'
    );

INSERT INTO `mst_icon` VALUES (77, 'fa-crop', 'fa fa-crop');

INSERT INTO
    `mst_icon`
VALUES (
        78,
        'fa-crosshairs',
        'fa fa-crosshairs'
    );

INSERT INTO `mst_icon` VALUES (79, 'fa-cube', 'fa fa-cube');

INSERT INTO `mst_icon` VALUES (80, 'fa-cubes', 'fa fa-cubes');

INSERT INTO `mst_icon` VALUES ( 81, 'fa-cutlery', 'fa fa-cutlery' );

INSERT INTO
    `mst_icon`
VALUES (
        82,
        'fa-dashboard',
        'fa fa-dashboard'
    );

INSERT INTO
    `mst_icon`
VALUES (
        83,
        'fa-database',
        'fa fa-database'
    );

INSERT INTO `mst_icon` VALUES ( 84, 'fa-desktop', 'fa fa-desktop' );

INSERT INTO
    `mst_icon`
VALUES (
        85,
        'fa-dot-circle-o',
        'fa fa-dot-circle-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        86,
        'fa-download',
        'fa fa-download'
    );

INSERT INTO `mst_icon` VALUES (87, 'fa-edit', 'fa fa-edit');

INSERT INTO
    `mst_icon`
VALUES (
        88,
        'fa-ellipsis-h',
        'fa fa-ellipsis-h'
    );

INSERT INTO
    `mst_icon`
VALUES (
        89,
        'fa-ellipsis-v',
        'fa fa-ellipsis-v'
    );

INSERT INTO
    `mst_icon`
VALUES (
        90,
        'fa-envelope',
        'fa fa-envelope'
    );

INSERT INTO
    `mst_icon`
VALUES (
        91,
        'fa-envelope-o',
        'fa fa-envelope-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        92,
        'fa-envelope-square',
        'fa fa-envelope-square'
    );

INSERT INTO `mst_icon` VALUES ( 93, 'fa-eraser', 'fa fa-eraser' );

INSERT INTO
    `mst_icon`
VALUES (
        94,
        'fa-exchange',
        'fa fa-exchange'
    );

INSERT INTO
    `mst_icon`
VALUES (
        95,
        'fa-exclamation',
        'fa fa-exclamation'
    );

INSERT INTO
    `mst_icon`
VALUES (
        96,
        'fa-exclamation-circle',
        'fa fa-exclamation-circle'
    );

INSERT INTO
    `mst_icon`
VALUES (
        97,
        'fa-exclamation-triangle',
        'fa fa-exclamation-triangle'
    );

INSERT INTO
    `mst_icon`
VALUES (
        98,
        'fa-external-link',
        'fa fa-external-link'
    );

INSERT INTO
    `mst_icon`
VALUES (
        99,
        'fa-external-link-square',
        'fa fa-external-link-square'
    );

INSERT INTO `mst_icon` VALUES (100, 'fa-eye', 'fa fa-eye');

INSERT INTO
    `mst_icon`
VALUES (
        101,
        'fa-eye-slash',
        'fa fa-eye-slash'
    );

INSERT INTO
    `mst_icon`
VALUES (
        102,
        'fa-eyedropper',
        'fa fa-eyedropper'
    );

INSERT INTO `mst_icon` VALUES (103, 'fa-fax', 'fa fa-fax');

INSERT INTO `mst_icon` VALUES ( 104, 'fa-female', 'fa fa-female' );

INSERT INTO
    `mst_icon`
VALUES (
        105,
        'fa-fighter-jet',
        'fa fa-fighter-jet'
    );

INSERT INTO
    `mst_icon`
VALUES (
        106,
        'fa-file-archive-o',
        'fa fa-file-archive-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        107,
        'fa-file-audio-o',
        'fa fa-file-audio-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        108,
        'fa-file-code-o',
        'fa fa-file-code-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        109,
        'fa-file-excel-o',
        'fa fa-file-excel-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        110,
        'fa-file-image-o',
        'fa fa-file-image-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        111,
        'fa-file-movie-o',
        'fa fa-file-movie-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        112,
        'fa-file-pdf-o',
        'fa fa-file-pdf-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        113,
        'fa-file-photo-o',
        'fa fa-file-photo-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        114,
        'fa-file-picture-o',
        'fa fa-file-picture-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        115,
        'fa-file-powerpoint-o',
        'fa fa-file-powerpoint-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        116,
        'fa-file-sound-o',
        'fa fa-file-sound-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        117,
        'fa-file-video-o',
        'fa fa-file-video-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        118,
        'fa-file-word-o',
        'fa fa-file-word-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        119,
        'fa-file-zip-o',
        'fa fa-file-zip-o'
    );

INSERT INTO `mst_icon` VALUES (120, 'fa-film', 'fa fa-film');

INSERT INTO `mst_icon` VALUES ( 121, 'fa-filter', 'fa fa-filter' );

INSERT INTO `mst_icon` VALUES (122, 'fa-fire', 'fa fa-fire');

INSERT INTO
    `mst_icon`
VALUES (
        123,
        'fa-fire-extinguisher',
        'fa fa-fire-extinguisher'
    );

INSERT INTO `mst_icon` VALUES (124, 'fa-flag', 'fa fa-flag');

INSERT INTO
    `mst_icon`
VALUES (
        125,
        'fa-flag-checkered',
        'fa fa-flag-checkered'
    );

INSERT INTO `mst_icon` VALUES ( 126, 'fa-flag-o', 'fa fa-flag-o' );

INSERT INTO `mst_icon` VALUES ( 127, 'fa-flash', 'fa fa-flash' );

INSERT INTO `mst_icon` VALUES ( 128, 'fa-flask', 'fa fa-flask' );

INSERT INTO `mst_icon` VALUES ( 129, 'fa-folder', 'fa fa-folder' );

INSERT INTO
    `mst_icon`
VALUES (
        130,
        'fa-folder-o',
        'fa fa-folder-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        131,
        'fa-folder-open',
        'fa fa-folder-open'
    );

INSERT INTO
    `mst_icon`
VALUES (
        132,
        'fa-folder-open-o',
        'fa fa-folder-open-o'
    );

INSERT INTO `mst_icon` VALUES ( 133, 'fa fa-frown-o', 'fa-frown-o' );

INSERT INTO
    `mst_icon`
VALUES (
        134,
        'fa fa-futbol-o',
        'fa-futbol-o'
    );

INSERT INTO `mst_icon` VALUES ( 135, 'fa fa-gamepad', 'fa-gamepad' );

INSERT INTO `mst_icon` VALUES ( 136, 'fa fa-gavel', 'fa-gavel' );

INSERT INTO `mst_icon` VALUES (137, 'fa fa-gear', 'fa-gear');

INSERT INTO `mst_icon` VALUES ( 138, 'fa fa-gears', 'fa-gears' );

INSERT INTO `mst_icon` VALUES (139, 'fa fa-gift', 'fa-gift');

INSERT INTO `mst_icon` VALUES ( 140, 'fa fa-glass', 'fa-glass' );

INSERT INTO `mst_icon` VALUES ( 141, 'fa fa-globe', 'fa-globe' );

INSERT INTO
    `mst_icon`
VALUES (
        142,
        'fa fa-graduation-cap',
        'fa-graduation-cap'
    );

INSERT INTO `mst_icon` VALUES ( 143, 'fa fa-group', 'fa-group' );

INSERT INTO `mst_icon` VALUES ( 144, 'fa fa-hdd-o', 'fa-hdd-o' );

INSERT INTO
    `mst_icon`
VALUES (
        145,
        'fa fa-headphones',
        'fa-headphones'
    );

INSERT INTO `mst_icon` VALUES ( 146, 'fa fa-heart', 'fa-heart' );

INSERT INTO `mst_icon` VALUES ( 147, 'fa fa-heart-o', 'fa-heart-o' );

INSERT INTO `mst_icon` VALUES ( 148, 'fa fa-history', 'fa-history' );

INSERT INTO `mst_icon` VALUES (149, 'fa fa-home', 'fa-home');

INSERT INTO `mst_icon` VALUES ( 150, 'fa fa-image', 'fa-image' );

INSERT INTO `mst_icon` VALUES ( 151, 'fa fa-inbox', 'fa-inbox' );

INSERT INTO `mst_icon` VALUES (152, 'fa fa-info', 'fa-info');

INSERT INTO
    `mst_icon`
VALUES (
        153,
        'fa fa-info-circle',
        'fa-info-circle'
    );

INSERT INTO
    `mst_icon`
VALUES (
        154,
        'fa fa-institution',
        'fa-institution'
    );

INSERT INTO `mst_icon` VALUES (155, 'fa fa-key', 'fa-key');

INSERT INTO
    `mst_icon`
VALUES (
        156,
        'fa fa-keyboard-o',
        'fa-keyboard-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        157,
        'fa fa-language',
        'fa-language'
    );

INSERT INTO `mst_icon` VALUES ( 158, 'fa fa-laptop', 'fa-laptop' );

INSERT INTO `mst_icon` VALUES (159, 'fa fa-leaf', 'fa-leaf');

INSERT INTO `mst_icon` VALUES ( 160, 'fa fa-legal', 'fa-legal' );

INSERT INTO `mst_icon` VALUES ( 161, 'fa fa-lemon-o', 'fa-lemon-o' );

INSERT INTO
    `mst_icon`
VALUES (
        162,
        'fa fa-level-down',
        'fa-level-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        163,
        'fa fa-level-up',
        'fa-level-up'
    );

INSERT INTO
    `mst_icon`
VALUES (
        164,
        'fa fa-life-bouy',
        'fa-life-bouy'
    );

INSERT INTO
    `mst_icon`
VALUES (
        165,
        'fa fa-life-buoy',
        'fa-life-buoy'
    );

INSERT INTO
    `mst_icon`
VALUES (
        166,
        'fa fa-life-ring',
        'fa-life-ring'
    );

INSERT INTO
    `mst_icon`
VALUES (
        167,
        'fa fa-life-saver',
        'fa-life-saver'
    );

INSERT INTO
    `mst_icon`
VALUES (
        168,
        'fa fa-lightbulb-o',
        'fa-lightbulb-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        169,
        'fa fa-line-chart',
        'fa-line-chart'
    );

INSERT INTO
    `mst_icon`
VALUES (
        170,
        'fa fa-location-arrow',
        'fa-location-arrow'
    );

INSERT INTO `mst_icon` VALUES (171, 'fa fa-lock', 'fa-lock');

INSERT INTO `mst_icon` VALUES ( 172, 'fa fa-magic', 'fa-magic' );

INSERT INTO `mst_icon` VALUES ( 173, 'fa fa-magnet', 'fa-magnet' );

INSERT INTO
    `mst_icon`
VALUES (
        174,
        'fa fa-mail-forward',
        'fa-mail-forward'
    );

INSERT INTO
    `mst_icon`
VALUES (
        175,
        'fa fa-mail-reply',
        'fa-mail-reply'
    );

INSERT INTO
    `mst_icon`
VALUES (
        176,
        'fa fa-mail-reply-all',
        'fa-mail-reply-all'
    );

INSERT INTO `mst_icon` VALUES (177, 'fa fa-male', 'fa-male');

INSERT INTO
    `mst_icon`
VALUES (
        178,
        'fa fa-map-marker',
        'fa-map-marker'
    );

INSERT INTO `mst_icon` VALUES ( 179, 'fa fa-meh-o', 'fa-meh-o' );

INSERT INTO
    `mst_icon`
VALUES (
        180,
        'fa fa-microphone',
        'fa-microphone'
    );

INSERT INTO
    `mst_icon`
VALUES (
        181,
        'fa fa-microphone-slash',
        'fa-microphone-slash'
    );

INSERT INTO `mst_icon` VALUES ( 182, 'fa fa-minus', 'fa-minus' );

INSERT INTO
    `mst_icon`
VALUES (
        183,
        'fa fa-minus-circle',
        'fa-minus-circle'
    );

INSERT INTO
    `mst_icon`
VALUES (
        184,
        'fa fa-minus-square',
        'fa-minus-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        185,
        'fa fa-minus-square-o',
        'fa-minus-square-o'
    );

INSERT INTO `mst_icon` VALUES ( 186, 'fa fa-mobile', 'fa-mobile' );

INSERT INTO
    `mst_icon`
VALUES (
        187,
        'fa fa-mobile-phone',
        'fa-mobile-phone'
    );

INSERT INTO `mst_icon` VALUES ( 188, 'fa fa-money', 'fa-money' );

INSERT INTO `mst_icon` VALUES ( 189, 'fa fa-moon-o', 'fa-moon-o' );

INSERT INTO
    `mst_icon`
VALUES (
        190,
        'fa fa-mortar-board',
        'fa-mortar-board'
    );

INSERT INTO `mst_icon` VALUES ( 191, 'fa fa-music', 'fa-music' );

INSERT INTO `mst_icon` VALUES ( 192, 'fa fa-navicon', 'fa-navicon' );

INSERT INTO
    `mst_icon`
VALUES (
        193,
        'fa fa-newspaper-o',
        'fa-newspaper-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        194,
        'fa fa-paint-brush',
        'fa-paint-brush'
    );

INSERT INTO
    `mst_icon`
VALUES (
        195,
        'fa fa-paper-plane',
        'fa-paper-plane'
    );

INSERT INTO
    `mst_icon`
VALUES (
        196,
        'fa fa-paper-plane-o',
        'fa-paper-plane-o'
    );

INSERT INTO `mst_icon` VALUES (197, 'fa fa-paw', 'fa-paw');

INSERT INTO `mst_icon` VALUES ( 198, 'fa fa-pencil', 'fa-pencil' );

INSERT INTO
    `mst_icon`
VALUES (
        199,
        'fa fa-pencil-square',
        'fa-pencil-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        200,
        'fa fa-pencil-square-o',
        'fa-pencil-square-o'
    );

INSERT INTO `mst_icon` VALUES ( 201, 'fa fa-phone', 'fa-phone' );

INSERT INTO
    `mst_icon`
VALUES (
        202,
        'fa fa-phone-square',
        'fa-phone-square'
    );

INSERT INTO `mst_icon` VALUES ( 203, 'fa fa-photo', 'fa-photo' );

INSERT INTO
    `mst_icon`
VALUES (
        204,
        'fa fa-picture-o',
        'fa-picture-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        205,
        'fa fa-pie-chart',
        'fa-pie-chart'
    );

INSERT INTO `mst_icon` VALUES ( 206, 'fa fa-plane', 'fa-plane' );

INSERT INTO `mst_icon` VALUES (207, 'fa fa-plug', 'fa-plug');

INSERT INTO `mst_icon` VALUES (208, 'fa fa-plus', 'fa-plus');

INSERT INTO
    `mst_icon`
VALUES (
        209,
        'fa fa-plus-circle',
        'fa-plus-circle'
    );

INSERT INTO
    `mst_icon`
VALUES (
        210,
        'fa fa-plus-square',
        'fa-plus-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        211,
        'fa fa-plus-square-o',
        'fa-plus-square-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        212,
        'fa fa-power-off',
        'fa-power-off'
    );

INSERT INTO `mst_icon` VALUES ( 213, 'fa fa-print', 'fa-print' );

INSERT INTO
    `mst_icon`
VALUES (
        214,
        'fa fa-puzzle-piece',
        'fa-puzzle-piece'
    );

INSERT INTO `mst_icon` VALUES ( 215, 'fa fa-qrcode', 'fa-qrcode' );

INSERT INTO
    `mst_icon`
VALUES (
        216,
        'fa fa-question',
        'fa-question'
    );

INSERT INTO
    `mst_icon`
VALUES (
        217,
        'fa fa-question-circle',
        'fa-question-circle'
    );

INSERT INTO
    `mst_icon`
VALUES (
        218,
        'fa fa-quote-left',
        'fa-quote-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        219,
        'fa fa-quote-right',
        'fa-quote-right'
    );

INSERT INTO `mst_icon` VALUES ( 220, 'fa fa-random', 'fa-random' );

INSERT INTO `mst_icon` VALUES ( 221, 'fa fa-recycle', 'fa-recycle' );

INSERT INTO `mst_icon` VALUES ( 222, 'fa fa-refresh', 'fa-refresh' );

INSERT INTO `mst_icon` VALUES ( 223, 'fa fa-remove', 'fa-remove' );

INSERT INTO `mst_icon` VALUES ( 224, 'fa fa-reorder', 'fa-reorder' );

INSERT INTO `mst_icon` VALUES ( 225, 'fa fa-reply', 'fa-reply' );

INSERT INTO
    `mst_icon`
VALUES (
        226,
        'fa fa-reply-all',
        'fa-reply-all'
    );

INSERT INTO `mst_icon` VALUES ( 227, 'fa fa-retweet', 'fa-retweet' );

INSERT INTO `mst_icon` VALUES (228, 'fa fa-road', 'fa-road');

INSERT INTO `mst_icon` VALUES ( 229, 'fa fa-rocket', 'fa-rocket' );

INSERT INTO `mst_icon` VALUES (230, 'fa fa-rss', 'fa-rss');

INSERT INTO
    `mst_icon`
VALUES (
        231,
        'fa fa-rss-square',
        'fa-rss-square'
    );

INSERT INTO `mst_icon` VALUES ( 232, 'fa fa-search', 'fa-search' );

INSERT INTO
    `mst_icon`
VALUES (
        233,
        'fa fa-search-minus',
        'fa-search-minus'
    );

INSERT INTO
    `mst_icon`
VALUES (
        234,
        'fa fa-search-plus',
        'fa-search-plus'
    );

INSERT INTO `mst_icon` VALUES (235, 'fa fa-send', 'fa-send');

INSERT INTO `mst_icon` VALUES ( 236, 'fa fa-send-o', 'fa-send-o' );

INSERT INTO `mst_icon` VALUES ( 237, 'fa fa-share', 'fa-share' );

INSERT INTO
    `mst_icon`
VALUES (
        238,
        'fa fa-share-alt',
        'fa-share-alt'
    );

INSERT INTO
    `mst_icon`
VALUES (
        239,
        'fa fa-share-alt-square',
        'fa-share-alt-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        240,
        'fa fa-share-square',
        'fa-share-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        241,
        'fa fa-share-square-o',
        'fa-share-square-o'
    );

INSERT INTO `mst_icon` VALUES ( 242, 'fa fa-shield', 'fa-shield' );

INSERT INTO
    `mst_icon`
VALUES (
        243,
        'fa fa-shopping-cart',
        'fa-shopping-cart'
    );

INSERT INTO `mst_icon` VALUES ( 244, 'fa fa-sign-in', 'fa-sign-in' );

INSERT INTO
    `mst_icon`
VALUES (
        245,
        'fa fa-sign-out',
        'fa-sign-out'
    );

INSERT INTO `mst_icon` VALUES ( 246, 'fa fa-signal', 'fa-signal' );

INSERT INTO `mst_icon` VALUES ( 247, 'fa fa-sitemap', 'fa-sitemap' );

INSERT INTO `mst_icon` VALUES ( 248, 'fa fa-sliders', 'fa-sliders' );

INSERT INTO `mst_icon` VALUES ( 249, 'fa fa-smile-o', 'fa-smile-o' );

INSERT INTO
    `mst_icon`
VALUES (
        250,
        'fa fa-soccer-ball-o',
        'fa-soccer-ball-o'
    );

INSERT INTO `mst_icon` VALUES (251, 'fa fa-sort', 'fa-sort');

INSERT INTO
    `mst_icon`
VALUES (
        252,
        'fa fa-sort-alpha-asc',
        'fa-sort-alpha-asc'
    );

INSERT INTO
    `mst_icon`
VALUES (
        253,
        'fa fa-sort-alpha-desc',
        'fa-sort-alpha-desc'
    );

INSERT INTO
    `mst_icon`
VALUES (
        254,
        'fa fa-sort-amount-asc',
        'fa-sort-amount-asc'
    );

INSERT INTO
    `mst_icon`
VALUES (
        255,
        'fa fa-sort-amount-desc',
        'fa-sort-amount-desc'
    );

INSERT INTO
    `mst_icon`
VALUES (
        256,
        'fa fa-sort-asc',
        'fa-sort-asc'
    );

INSERT INTO
    `mst_icon`
VALUES (
        257,
        'fa fa-sort-desc',
        'fa-sort-desc'
    );

INSERT INTO
    `mst_icon`
VALUES (
        258,
        'fa fa-sort-down',
        'fa-sort-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        259,
        'fa fa-sort-numeric-asc',
        'fa-sort-numeric-asc'
    );

INSERT INTO
    `mst_icon`
VALUES (
        260,
        'fa fa-sort-numeric-desc',
        'fa-sort-numeric-desc'
    );

INSERT INTO `mst_icon` VALUES ( 261, 'fa fa-sort-up', 'fa-sort-up' );

INSERT INTO
    `mst_icon`
VALUES (
        262,
        'fa fa-space-shuttle',
        'fa-space-shuttle'
    );

INSERT INTO `mst_icon` VALUES ( 263, 'fa fa-spinner', 'fa-spinner' );

INSERT INTO `mst_icon` VALUES ( 264, 'fa fa-spoon', 'fa-spoon' );

INSERT INTO `mst_icon` VALUES ( 265, 'fa fa-square', 'fa-square' );

INSERT INTO
    `mst_icon`
VALUES (
        266,
        'fa fa-square-o',
        'fa-square-o'
    );

INSERT INTO `mst_icon` VALUES (267, 'fa fa-star', 'fa-star');

INSERT INTO
    `mst_icon`
VALUES (
        268,
        'fa fa-star-half',
        'fa-star-half'
    );

INSERT INTO
    `mst_icon`
VALUES (
        269,
        'fa fa-star-half-empty',
        'fa-star-half-empty'
    );

INSERT INTO
    `mst_icon`
VALUES (
        270,
        'fa fa-star-half-full',
        'fa-star-half-full'
    );

INSERT INTO
    `mst_icon`
VALUES (
        271,
        'fa fa-star-half-o',
        'fa-star-half-o'
    );

INSERT INTO `mst_icon` VALUES ( 272, 'fa fa-star-o', 'fa-star-o' );

INSERT INTO
    `mst_icon`
VALUES (
        273,
        'fa fa-suitcase',
        'fa-suitcase'
    );

INSERT INTO `mst_icon` VALUES ( 274, 'fa fa-sun-o', 'fa-sun-o' );

INSERT INTO `mst_icon` VALUES ( 275, 'fa fa-support', 'fa-support' );

INSERT INTO `mst_icon` VALUES ( 276, 'fa fa-tablet', 'fa-tablet' );

INSERT INTO
    `mst_icon`
VALUES (
        277,
        'fa fa-tachometer',
        'fa-tachometer'
    );

INSERT INTO `mst_icon` VALUES (278, 'fa fa-tag', 'fa-tag');

INSERT INTO `mst_icon` VALUES (279, 'fa fa-tags', 'fa-tags');

INSERT INTO `mst_icon` VALUES ( 280, 'fa fa-tasks', 'fa-tasks' );

INSERT INTO `mst_icon` VALUES (281, 'fa fa-taxi', 'fa-taxi');

INSERT INTO
    `mst_icon`
VALUES (
        282,
        'fa fa-terminal',
        'fa-terminal'
    );

INSERT INTO
    `mst_icon`
VALUES (
        283,
        'fa fa-thumb-tack',
        'fa-thumb-tack'
    );

INSERT INTO
    `mst_icon`
VALUES (
        284,
        'fa fa-thumbs-down',
        'fa-thumbs-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        285,
        'fa fa-thumbs-o-down',
        'fa-thumbs-o-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        286,
        'fa fa-thumbs-o-up',
        'fa-thumbs-o-up'
    );

INSERT INTO
    `mst_icon`
VALUES (
        287,
        'fa fa-thumbs-up',
        'fa-thumbs-up'
    );

INSERT INTO `mst_icon` VALUES ( 288, 'fa fa-ticket', 'fa-ticket' );

INSERT INTO `mst_icon` VALUES ( 289, 'fa fa-times', 'fa-times' );

INSERT INTO
    `mst_icon`
VALUES (
        290,
        'fa fa-times-circle',
        'fa-times-circle'
    );

INSERT INTO
    `mst_icon`
VALUES (
        291,
        'fa fa-times-circle-o',
        'fa-times-circle-o'
    );

INSERT INTO `mst_icon` VALUES (292, 'fa fa-tint', 'fa-tint');

INSERT INTO
    `mst_icon`
VALUES (
        293,
        'fa fa-toggle-down',
        'fa-toggle-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        294,
        'fa fa-toggle-left',
        'fa-toggle-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        295,
        'fa fa-toggle-off',
        'fa-toggle-off'
    );

INSERT INTO
    `mst_icon`
VALUES (
        296,
        'fa fa-toggle-on',
        'fa-toggle-on'
    );

INSERT INTO
    `mst_icon`
VALUES (
        297,
        'fa fa-toggle-right',
        'fa-toggle-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        298,
        'fa fa-toggle-up',
        'fa-toggle-up'
    );

INSERT INTO `mst_icon` VALUES ( 299, 'fa fa-trash', 'fa-trash' );

INSERT INTO `mst_icon` VALUES ( 300, 'fa fa-trash-o', 'fa-trash-o' );

INSERT INTO `mst_icon` VALUES (301, 'fa fa-tree', 'fa-tree');

INSERT INTO `mst_icon` VALUES ( 302, 'fa fa-trophy', 'fa-trophy' );

INSERT INTO `mst_icon` VALUES ( 303, 'fa fa-truck', 'fa-truck' );

INSERT INTO `mst_icon` VALUES (304, 'fa fa-tty', 'fa-tty');

INSERT INTO
    `mst_icon`
VALUES (
        305,
        'fa fa-umbrella',
        'fa-umbrella'
    );

INSERT INTO
    `mst_icon`
VALUES (
        306,
        'fa fa-university',
        'fa-university'
    );

INSERT INTO `mst_icon` VALUES ( 307, 'fa fa-unlock', 'fa-unlock' );

INSERT INTO
    `mst_icon`
VALUES (
        308,
        'fa fa-unlock-alt',
        'fa-unlock-alt'
    );

INSERT INTO
    `mst_icon`
VALUES (
        309,
        'fa fa-unsorted',
        'fa-unsorted'
    );

INSERT INTO `mst_icon` VALUES ( 310, 'fa fa-upload', 'fa-upload' );

INSERT INTO `mst_icon` VALUES (311, 'fa fa-user', 'fa-user');

INSERT INTO `mst_icon` VALUES ( 312, 'fa fa-users', 'fa-users' );

INSERT INTO
    `mst_icon`
VALUES (
        313,
        'fa fa-video-camera',
        'fa-video-camera'
    );

INSERT INTO
    `mst_icon`
VALUES (
        314,
        'fa fa-volume-down',
        'fa-volume-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        315,
        'fa fa-volume-off',
        'fa-volume-off'
    );

INSERT INTO
    `mst_icon`
VALUES (
        316,
        'fa fa-volume-up',
        'fa-volume-up'
    );

INSERT INTO `mst_icon` VALUES ( 317, 'fa fa-warning', 'fa-warning' );

INSERT INTO
    `mst_icon`
VALUES (
        318,
        'fa fa-wheelchair',
        'fa-wheelchair'
    );

INSERT INTO `mst_icon` VALUES (319, 'fa fa-wifi', 'fa-wifi');

INSERT INTO `mst_icon` VALUES ( 320, 'fa fa-wrench', 'fa-wrench' );

INSERT INTO `mst_icon` VALUES (321, 'fa fa-file', 'fa-file');

INSERT INTO
    `mst_icon`
VALUES (
        322,
        'fa fa-file-archive-o',
        'fa-file-archive-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        323,
        'fa fa-file-audio-o',
        'fa-file-audio-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        324,
        'fa fa-file-code-o',
        'fa-file-code-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        325,
        'fa fa-file-excel-o',
        'fa-file-excel-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        326,
        'fa fa-file-image-o',
        'fa-file-image-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        327,
        'fa fa-file-movie-o',
        'fa-file-movie-o'
    );

INSERT INTO `mst_icon` VALUES ( 328, 'fa fa-file-o', 'fa-file-o' );

INSERT INTO
    `mst_icon`
VALUES (
        329,
        'fa fa-file-pdf-o',
        'fa-file-pdf-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        330,
        'fa fa-file-photo-o',
        'fa-file-photo-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        331,
        'fa fa-file-picture-o',
        'fa-file-picture-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        332,
        'fa fa-file-powerpoint-o',
        'fa-file-powerpoint-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        333,
        'fa fa-file-sound-o',
        'fa-file-sound-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        334,
        'fa fa-file-text',
        'fa-file-text'
    );

INSERT INTO
    `mst_icon`
VALUES (
        335,
        'fa fa-file-text-o',
        'fa-file-text-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        336,
        'fa fa-file-video-o',
        'fa-file-video-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        337,
        'fa fa-file-word-o',
        'fa-file-word-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        338,
        'fa fa-file-zip-o',
        'fa-file-zip-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        339,
        'fa fa-info-circle fa-lg fa-li',
        'fa-info-circle'
    );

INSERT INTO
    `mst_icon`
VALUES (
        340,
        'fa fa-circle-o-notch',
        'fa-circle-o-notch'
    );

INSERT INTO `mst_icon` VALUES (341, 'fa fa-cog', 'fa-cog');

INSERT INTO `mst_icon` VALUES (342, 'fa fa-gear', 'fa-gear');

INSERT INTO `mst_icon` VALUES ( 343, 'fa fa-refresh', 'fa-refresh' );

INSERT INTO `mst_icon` VALUES ( 344, 'fa fa-spinner', 'fa-spinner' );

INSERT INTO
    `mst_icon`
VALUES (
        345,
        'fa fa-check-square',
        'fa-check-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        346,
        'fa fa-check-square-o',
        'fa-check-square-o'
    );

INSERT INTO `mst_icon` VALUES ( 347, 'fa fa-circle', 'fa-circle' );

INSERT INTO
    `mst_icon`
VALUES (
        348,
        'fa fa-circle-o',
        'fa-circle-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        349,
        'fa fa-dot-circle-o',
        'fa-dot-circle-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        350,
        'fa fa-minus-square',
        'fa-minus-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        351,
        'fa fa-minus-square-o',
        'fa-minus-square-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        352,
        'fa fa-plus-square',
        'fa-plus-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        353,
        'fa fa-plus-square-o',
        'fa-plus-square-o'
    );

INSERT INTO `mst_icon` VALUES ( 354, 'fa fa-square', 'fa-square' );

INSERT INTO
    `mst_icon`
VALUES (
        355,
        'fa fa-square-o',
        'fa-square-o'
    );

INSERT INTO `mst_icon` VALUES ( 356, 'fa fa-cc-amex', 'fa-cc-amex' );

INSERT INTO
    `mst_icon`
VALUES (
        357,
        'fa fa-cc-discover',
        'fa-cc-discover'
    );

INSERT INTO
    `mst_icon`
VALUES (
        358,
        'fa fa-cc-mastercard',
        'fa-cc-mastercard'
    );

INSERT INTO
    `mst_icon`
VALUES (
        359,
        'fa fa-cc-paypal',
        'fa-cc-paypal'
    );

INSERT INTO
    `mst_icon`
VALUES (
        360,
        'fa fa-cc-stripe',
        'fa-cc-stripe'
    );

INSERT INTO `mst_icon` VALUES ( 361, 'fa fa-cc-visa', 'fa-cc-visa' );

INSERT INTO
    `mst_icon`
VALUES (
        362,
        'fa fa-credit-card',
        'fa-credit-card'
    );

INSERT INTO
    `mst_icon`
VALUES (
        363,
        'fa fa-google-wallet',
        'fa-google-wallet'
    );

INSERT INTO `mst_icon` VALUES ( 364, 'fa fa-paypal', 'fa-paypal' );

INSERT INTO
    `mst_icon`
VALUES (
        365,
        'fa fa-area-chart',
        'fa-area-chart'
    );

INSERT INTO
    `mst_icon`
VALUES (
        366,
        'fa fa-bar-chart',
        'fa-bar-chart'
    );

INSERT INTO
    `mst_icon`
VALUES (
        367,
        'fa fa-bar-chart-o',
        'fa-bar-chart-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        368,
        'fa fa-line-chart',
        'fa-line-chart'
    );

INSERT INTO
    `mst_icon`
VALUES (
        369,
        'fa fa-pie-chart',
        'fa-pie-chart'
    );

INSERT INTO `mst_icon` VALUES ( 370, 'fa fa-bitcoin', 'fa-bitcoin' );

INSERT INTO `mst_icon` VALUES (371, 'fa fa-btc', 'fa-btc');

INSERT INTO `mst_icon` VALUES (372, 'fa fa-cny', 'fa-cny');

INSERT INTO `mst_icon` VALUES ( 373, 'fa fa-dollar', 'fa-dollar' );

INSERT INTO `mst_icon` VALUES (374, 'fa fa-eur', 'fa-eur');

INSERT INTO `mst_icon` VALUES (375, 'fa fa-euro', 'fa-euro');

INSERT INTO `mst_icon` VALUES (376, 'fa fa-gbp', 'fa-gbp');

INSERT INTO `mst_icon` VALUES (377, 'fa fa-ils', 'fa-ils');

INSERT INTO `mst_icon` VALUES (378, 'fa fa-inr', 'fa-inr');

INSERT INTO `mst_icon` VALUES (379, 'fa fa-jpy', 'fa-jpy');

INSERT INTO `mst_icon` VALUES (380, 'fa fa-krw', 'fa-krw');

INSERT INTO `mst_icon` VALUES ( 381, 'fa fa-money', 'fa-money' );

INSERT INTO `mst_icon` VALUES (382, 'fa fa-rmb', 'fa-rmb');

INSERT INTO `mst_icon` VALUES ( 383, 'fa fa-rouble', 'fa-rouble' );

INSERT INTO `mst_icon` VALUES (384, 'fa fa-rub', 'fa-rub');

INSERT INTO `mst_icon` VALUES ( 385, 'fa fa-ruble', 'fa-ruble' );

INSERT INTO `mst_icon` VALUES ( 386, 'fa fa-rupee', 'fa-rupee' );

INSERT INTO `mst_icon` VALUES ( 387, 'fa fa-shekel', 'fa-shekel' );

INSERT INTO `mst_icon` VALUES ( 388, 'fa fa-sheqel', 'fa-sheqel' );

INSERT INTO `mst_icon` VALUES (389, 'fa fa-try', 'fa-try');

INSERT INTO
    `mst_icon`
VALUES (
        390,
        'fa fa-turkish-lira',
        'fa-turkish-lira'
    );

INSERT INTO `mst_icon` VALUES (391, 'fa fa-usd', 'fa-usd');

INSERT INTO `mst_icon` VALUES (392, 'fa fa-won', 'fa-won');

INSERT INTO `mst_icon` VALUES (393, 'fa fa-yen', 'fa-yen');

INSERT INTO
    `mst_icon`
VALUES (
        394,
        'fa fa-align-center',
        'fa-align-center'
    );

INSERT INTO
    `mst_icon`
VALUES (
        395,
        'fa fa-align-justify',
        'fa-align-justify'
    );

INSERT INTO
    `mst_icon`
VALUES (
        396,
        'fa fa-align-left',
        'fa-align-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        397,
        'fa fa-align-right',
        'fa-align-right'
    );

INSERT INTO `mst_icon` VALUES (398, 'fa fa-bold', 'fa-bold');

INSERT INTO `mst_icon` VALUES ( 399, 'fa fa-chain', 'fa-chain' );

INSERT INTO
    `mst_icon`
VALUES (
        400,
        'fa fa-chain-broken',
        'fa-chain-broken'
    );

INSERT INTO
    `mst_icon`
VALUES (
        401,
        'fa fa-clipboard',
        'fa-clipboard'
    );

INSERT INTO `mst_icon` VALUES ( 402, 'fa fa-columns', 'fa-columns' );

INSERT INTO `mst_icon` VALUES (403, 'fa fa-copy', 'fa-copy');

INSERT INTO `mst_icon` VALUES (404, 'fa fa-cut', 'fa-cut');

INSERT INTO `mst_icon` VALUES ( 405, 'fa fa-dedent', 'fa-dedent' );

INSERT INTO `mst_icon` VALUES ( 406, 'fa fa-eraser', 'fa-eraser' );

INSERT INTO `mst_icon` VALUES (407, 'fa fa-file', 'fa-file');

INSERT INTO `mst_icon` VALUES ( 408, 'fa fa-file-o', 'fa-file-o' );

INSERT INTO
    `mst_icon`
VALUES (
        409,
        'fa fa-file-text',
        'fa-file-text'
    );

INSERT INTO
    `mst_icon`
VALUES (
        410,
        'fa fa-file-text-o',
        'fa-file-text-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        411,
        'fa fa-chevron-circle-up',
        'fa-chevron-circle-up'
    );

INSERT INTO
    `mst_icon`
VALUES (
        412,
        'fa fa-chevron-down',
        'fa-chevron-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        413,
        'fa fa-chevron-left',
        'fa-chevron-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        414,
        'fa fa-chevron-right',
        'fa-chevron-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        415,
        'fa fa-chevron-up',
        'fa-chevron-up'
    );

INSERT INTO
    `mst_icon`
VALUES (
        416,
        'fa fa-hand-o-down',
        'fa-hand-o-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        417,
        'fa fa-hand-o-left',
        'fa-hand-o-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        418,
        'fa fa-hand-o-right',
        'fa-hand-o-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        419,
        'fa fa-hand-o-up',
        'fa-hand-o-up'
    );

INSERT INTO
    `mst_icon`
VALUES (
        420,
        'fa fa-long-arrow-down',
        'fa-long-arrow-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        421,
        'fa fa-long-arrow-left',
        'fa-long-arrow-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        422,
        'fa fa-long-arrow-right',
        'fa-long-arrow-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        423,
        'fa fa-long-arrow-up',
        'fa-long-arrow-up'
    );

INSERT INTO
    `mst_icon`
VALUES (
        424,
        'fa fa-toggle-down',
        'fa-toggle-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        425,
        'fa fa-toggle-left',
        'fa-toggle-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        426,
        'fa fa-toggle-right',
        'fa-toggle-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        427,
        'fa fa-toggle-up',
        'fa-toggle-up'
    );

INSERT INTO
    `mst_icon`
VALUES (
        428,
        'fa fa-arrows-alt',
        'fa-arrows-alt'
    );

INSERT INTO
    `mst_icon`
VALUES (
        429,
        'fa fa-backward',
        'fa-backward'
    );

INSERT INTO
    `mst_icon`
VALUES (
        430,
        'fa fa-compress',
        'fa-compress'
    );

INSERT INTO `mst_icon` VALUES ( 431, 'fa fa-eject', 'fa-eject' );

INSERT INTO `mst_icon` VALUES ( 432, 'fa fa-expand', 'fa-expand' );

INSERT INTO
    `mst_icon`
VALUES (
        433,
        'fa fa-fast-backward',
        'fa-fast-backward'
    );

INSERT INTO
    `mst_icon`
VALUES (
        434,
        'fa fa-fast-forward',
        'fa-fast-forward'
    );

INSERT INTO `mst_icon` VALUES ( 435, 'fa fa-forward', 'fa-forward' );

INSERT INTO `mst_icon` VALUES ( 436, 'fa fa-pause', 'fa-pause' );

INSERT INTO `mst_icon` VALUES (437, 'fa fa-play', 'fa-play');

INSERT INTO
    `mst_icon`
VALUES (
        438,
        'fa fa-play-circle',
        'fa-play-circle'
    );

INSERT INTO
    `mst_icon`
VALUES (
        439,
        'fa fa-play-circle-o',
        'fa-play-circle-o'
    );

INSERT INTO
    `mst_icon`
VALUES (
        440,
        'fa fa-step-backward',
        'fa-step-backward'
    );

INSERT INTO
    `mst_icon`
VALUES (
        441,
        'fa fa-step-forward',
        'fa-step-forward'
    );

INSERT INTO `mst_icon` VALUES (442, 'fa fa-stop', 'fa-stop');

INSERT INTO
    `mst_icon`
VALUES (
        443,
        'fa fa-youtube-play',
        'fa-youtube-play'
    );

INSERT INTO `mst_icon` VALUES (444, 'fa fa-adn', 'fa-adn');

INSERT INTO `mst_icon` VALUES ( 445, 'fa fa-android', 'fa-android' );

INSERT INTO
    `mst_icon`
VALUES (
        446,
        'fa fa-angellist',
        'fa-angellist'
    );

INSERT INTO `mst_icon` VALUES ( 447, 'fa fa-apple', 'fa-apple' );

INSERT INTO `mst_icon` VALUES ( 448, 'fa fa-behance', 'fa-behance' );

INSERT INTO
    `mst_icon`
VALUES (
        449,
        'fa fa-behance-square',
        'fa-behance-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        450,
        'fa fa-bitbucket',
        'fa-bitbucket'
    );

INSERT INTO
    `mst_icon`
VALUES (
        451,
        'fa fa-bitbucket-square',
        'fa-bitbucket-square'
    );

INSERT INTO `mst_icon` VALUES ( 452, 'fa fa-bitcoin', 'fa-bitcoin' );

INSERT INTO `mst_icon` VALUES (453, 'fa fa-btc', 'fa-btc');

INSERT INTO `mst_icon` VALUES ( 454, 'fa fa-cc-amex', 'fa-cc-amex' );

INSERT INTO
    `mst_icon`
VALUES (
        455,
        'fa fa-cc-discover',
        'fa-cc-discover'
    );

INSERT INTO
    `mst_icon`
VALUES (
        456,
        'fa fa-cc-mastercard',
        'fa-cc-mastercard'
    );

INSERT INTO
    `mst_icon`
VALUES (
        457,
        'fa fa-cc-paypal',
        'fa-cc-paypal'
    );

INSERT INTO
    `mst_icon`
VALUES (
        458,
        'fa fa-cc-stripe',
        'fa-cc-stripe'
    );

INSERT INTO `mst_icon` VALUES ( 459, 'fa fa-cc-visa', 'fa-cc-visa' );

INSERT INTO `mst_icon` VALUES ( 460, 'fa fa-codepen', 'fa-codepen' );

INSERT INTO `mst_icon` VALUES (461, 'fa fa-css3', 'fa-css3');

INSERT INTO
    `mst_icon`
VALUES (
        462,
        'fa fa-delicious',
        'fa-delicious'
    );

INSERT INTO
    `mst_icon`
VALUES (
        463,
        'fa fa-deviantart',
        'fa-deviantart'
    );

INSERT INTO `mst_icon` VALUES (464, 'fa fa-digg', 'fa-digg');

INSERT INTO
    `mst_icon`
VALUES (
        465,
        'fa fa-dribbble',
        'fa-dribbble'
    );

INSERT INTO `mst_icon` VALUES ( 466, 'fa fa-dropbox', 'fa-dropbox' );

INSERT INTO `mst_icon` VALUES ( 467, 'fa fa-drupal', 'fa-drupal' );

INSERT INTO `mst_icon` VALUES ( 468, 'fa fa-empire', 'fa-empire' );

INSERT INTO
    `mst_icon`
VALUES (
        469,
        'fa fa-facebook',
        'fa-facebook'
    );

INSERT INTO
    `mst_icon`
VALUES (
        470,
        'fa fa-facebook-square',
        'fa-facebook-square'
    );

INSERT INTO `mst_icon` VALUES ( 471, 'fa fa-flickr', 'fa-flickr' );

INSERT INTO
    `mst_icon`
VALUES (
        472,
        'fa fa-foursquare',
        'fa-foursquare'
    );

INSERT INTO `mst_icon` VALUES (473, 'fa fa-ge', 'fa-ge');

INSERT INTO `mst_icon` VALUES (474, 'fa fa-git', 'fa-git');

INSERT INTO
    `mst_icon`
VALUES (
        475,
        'fa fa-git-square',
        'fa-git-square'
    );

INSERT INTO `mst_icon` VALUES ( 476, 'fa fa-github', 'fa-github' );

INSERT INTO
    `mst_icon`
VALUES (
        477,
        'fa fa-github-alt',
        'fa-github-alt'
    );

INSERT INTO
    `mst_icon`
VALUES (
        478,
        'fa fa-github-square',
        'fa-github-square'
    );

INSERT INTO `mst_icon` VALUES ( 479, 'fa fa-gittip', 'fa-gittip' );

INSERT INTO `mst_icon` VALUES ( 480, 'fa fa-google', 'fa-google' );

INSERT INTO
    `mst_icon`
VALUES (
        481,
        'fa fa-google-plus',
        'fa-google-plus'
    );

INSERT INTO
    `mst_icon`
VALUES (
        482,
        'fa fa-google-plus-square',
        'fa-google-plus-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        483,
        'fa fa-google-wallet',
        'fa-google-wallet'
    );

INSERT INTO
    `mst_icon`
VALUES (
        484,
        'fa fa-hacker-news',
        'fa-hacker-news'
    );

INSERT INTO `mst_icon` VALUES ( 485, 'fa fa-html5', 'fa-html5' );

INSERT INTO `mst_icon` VALUES ( 486, 'fa fa-files-o', 'fa-files-o' );

INSERT INTO
    `mst_icon`
VALUES (
        487,
        'fa fa-floppy-o',
        'fa-floppy-o'
    );

INSERT INTO `mst_icon` VALUES (488, 'fa fa-font', 'fa-font');

INSERT INTO `mst_icon` VALUES ( 489, 'fa fa-header', 'fa-header' );

INSERT INTO `mst_icon` VALUES ( 490, 'fa fa-indent', 'fa-indent' );

INSERT INTO `mst_icon` VALUES ( 491, 'fa fa-italic', 'fa-italic' );

INSERT INTO `mst_icon` VALUES (492, 'fa fa-link', 'fa-link');

INSERT INTO `mst_icon` VALUES (493, 'fa fa-list', 'fa-list');

INSERT INTO
    `mst_icon`
VALUES (
        494,
        'fa fa-list-alt',
        'fa-list-alt'
    );

INSERT INTO `mst_icon` VALUES ( 495, 'fa fa-list-ol', 'fa-list-ol' );

INSERT INTO `mst_icon` VALUES ( 496, 'fa fa-list-ul', 'fa-list-ul' );

INSERT INTO `mst_icon` VALUES ( 497, 'fa fa-outdent', 'fa-outdent' );

INSERT INTO
    `mst_icon`
VALUES (
        498,
        'fa fa-paperclip',
        'fa-paperclip'
    );

INSERT INTO
    `mst_icon`
VALUES (
        499,
        'fa fa-paragraph',
        'fa-paragraph'
    );

INSERT INTO `mst_icon` VALUES ( 500, 'fa fa-paste', 'fa-paste' );

INSERT INTO `mst_icon` VALUES ( 501, 'fa fa-repeat', 'fa-repeat' );

INSERT INTO
    `mst_icon`
VALUES (
        502,
        'fa fa-rotate-left',
        'fa-rotate-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        503,
        'fa fa-rotate-right',
        'fa-rotate-right'
    );

INSERT INTO `mst_icon` VALUES (504, 'fa fa-save', 'fa-save');

INSERT INTO
    `mst_icon`
VALUES (
        505,
        'fa fa-scissors',
        'fa-scissors'
    );

INSERT INTO
    `mst_icon`
VALUES (
        506,
        'fa fa-strikethrough',
        'fa-strikethrough'
    );

INSERT INTO
    `mst_icon`
VALUES (
        507,
        'fa fa-subscript',
        'fa-subscript'
    );

INSERT INTO
    `mst_icon`
VALUES (
        508,
        'fa fa-superscript',
        'fa-superscript'
    );

INSERT INTO `mst_icon` VALUES ( 509, 'fa fa-table', 'fa-table' );

INSERT INTO
    `mst_icon`
VALUES (
        510,
        'fa fa-text-height',
        'fa-text-height'
    );

INSERT INTO
    `mst_icon`
VALUES (
        511,
        'fa fa-text-width',
        'fa-text-width'
    );

INSERT INTO `mst_icon` VALUES (512, 'fa fa-th', 'fa-th');

INSERT INTO
    `mst_icon`
VALUES (
        513,
        'fa fa-th-large',
        'fa-th-large'
    );

INSERT INTO `mst_icon` VALUES ( 514, 'fa fa-th-list', 'fa-th-list' );

INSERT INTO
    `mst_icon`
VALUES (
        515,
        'fa fa-underline',
        'fa-underline'
    );

INSERT INTO `mst_icon` VALUES (516, 'fa fa-undo', 'fa-undo');

INSERT INTO `mst_icon` VALUES ( 517, 'fa fa-unlink', 'fa-unlink' );

INSERT INTO
    `mst_icon`
VALUES (
        518,
        'fa fa-angle-double-down',
        'fa-angle-double-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        519,
        'fa fa-angle-double-left',
        'fa-angle-double-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        520,
        'fa fa-angle-double-right',
        'fa-angle-double-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        521,
        'fa fa-angle-double-up',
        'fa-angle-double-up'
    );

INSERT INTO
    `mst_icon`
VALUES (
        522,
        'fa fa-angle-down',
        'fa-angle-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        523,
        'fa fa-angle-left',
        'fa-angle-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        524,
        'fa fa-angle-right',
        'fa-angle-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        525,
        'fa fa-angle-up',
        'fa-angle-up'
    );

INSERT INTO
    `mst_icon`
VALUES (
        526,
        'fa fa-arrow-circle-down',
        'fa-arrow-circle-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        527,
        'fa fa-arrow-circle-left',
        'fa-arrow-circle-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        528,
        'fa fa-arrow-circle-o-down',
        'fa-arrow-circle-o-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        529,
        'fa fa-arrow-circle-o-left',
        'fa-arrow-circle-o-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        530,
        'fa fa-arrow-circle-o-right',
        'fa-arrow-circle-o-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        531,
        'fa fa-arrow-circle-o-up',
        'fa-arrow-circle-o-up'
    );

INSERT INTO
    `mst_icon`
VALUES (
        532,
        'fa fa-arrow-circle-right',
        'fa-arrow-circle-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        533,
        'fa fa-arrow-circle-up',
        'fa-arrow-circle-up'
    );

INSERT INTO
    `mst_icon`
VALUES (
        534,
        'fa fa-arrow-down',
        'fa-arrow-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        535,
        'fa fa-arrow-left',
        'fa-arrow-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        536,
        'fa fa-arrow-right',
        'fa-arrow-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        537,
        'fa fa-arrow-up',
        'fa-arrow-up'
    );

INSERT INTO `mst_icon` VALUES ( 538, 'fa fa-arrows', 'fa-arrows' );

INSERT INTO
    `mst_icon`
VALUES (
        539,
        'fa fa-arrows-alt',
        'fa-arrows-alt'
    );

INSERT INTO
    `mst_icon`
VALUES (
        540,
        'fa fa-arrows-h',
        'fa-arrows-h'
    );

INSERT INTO
    `mst_icon`
VALUES (
        541,
        'fa fa-arrows-v',
        'fa-arrows-v'
    );

INSERT INTO
    `mst_icon`
VALUES (
        542,
        'fa fa-caret-down',
        'fa-caret-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        543,
        'fa fa-caret-left',
        'fa-caret-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        544,
        'fa fa-caret-right',
        'fa-caret-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        545,
        'fa fa-caret-square-o-down',
        'fa-caret-square-o-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        546,
        'fa fa-caret-square-o-left',
        'fa-caret-square-o-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        547,
        'fa fa-caret-square-o-right',
        'fa-caret-square-o-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        548,
        'fa fa-caret-square-o-up',
        'fa-caret-square-o-up'
    );

INSERT INTO
    `mst_icon`
VALUES (
        549,
        'fa fa-caret-up',
        'fa-caret-up'
    );

INSERT INTO
    `mst_icon`
VALUES (
        550,
        'fa fa-chevron-circle-down',
        'fa-chevron-circle-down'
    );

INSERT INTO
    `mst_icon`
VALUES (
        551,
        'fa fa-chevron-circle-left',
        'fa-chevron-circle-left'
    );

INSERT INTO
    `mst_icon`
VALUES (
        552,
        'fa fa-chevron-circle-right',
        'fa-chevron-circle-right'
    );

INSERT INTO
    `mst_icon`
VALUES (
        553,
        'fa fa-instagram',
        'fa-instagram'
    );

INSERT INTO `mst_icon` VALUES ( 554, 'fa fa-ioxhost', 'fa-ioxhost' );

INSERT INTO `mst_icon` VALUES ( 555, 'fa fa-joomla', 'fa-joomla' );

INSERT INTO
    `mst_icon`
VALUES (
        556,
        'fa fa-jsfiddle',
        'fa-jsfiddle'
    );

INSERT INTO `mst_icon` VALUES ( 557, 'fa fa-lastfm', 'fa-lastfm' );

INSERT INTO
    `mst_icon`
VALUES (
        558,
        'fa fa-lastfm-square',
        'fa-lastfm-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        559,
        'fa fa-linkedin',
        'fa-linkedin'
    );

INSERT INTO
    `mst_icon`
VALUES (
        560,
        'fa fa-linkedin-square',
        'fa-linkedin-square'
    );

INSERT INTO `mst_icon` VALUES ( 561, 'fa fa-linux', 'fa-linux' );

INSERT INTO `mst_icon` VALUES ( 562, 'fa fa-maxcdn', 'fa-maxcdn' );

INSERT INTO
    `mst_icon`
VALUES (
        563,
        'fa fa-meanpath',
        'fa-meanpath'
    );

INSERT INTO `mst_icon` VALUES ( 564, 'fa fa-openid', 'fa-openid' );

INSERT INTO
    `mst_icon`
VALUES (
        565,
        'fa fa-pagelines',
        'fa-pagelines'
    );

INSERT INTO `mst_icon` VALUES ( 566, 'fa fa-paypal', 'fa-paypal' );

INSERT INTO
    `mst_icon`
VALUES (
        567,
        'fa fa-pied-piper',
        'fa-pied-piper'
    );

INSERT INTO
    `mst_icon`
VALUES (
        568,
        'fa fa-pied-piper-alt',
        'fa-pied-piper-alt'
    );

INSERT INTO
    `mst_icon`
VALUES (
        569,
        'fa fa-pinterest',
        'fa-pinterest'
    );

INSERT INTO
    `mst_icon`
VALUES (
        570,
        'fa fa-pinterest-square',
        'fa-pinterest-square'
    );

INSERT INTO `mst_icon` VALUES (571, 'fa fa-qq', 'fa-qq');

INSERT INTO `mst_icon` VALUES (572, 'fa fa-ra', 'fa-ra');

INSERT INTO `mst_icon` VALUES ( 573, 'fa fa-rebel', 'fa-rebel' );

INSERT INTO `mst_icon` VALUES ( 574, 'fa fa-reddit', 'fa-reddit' );

INSERT INTO
    `mst_icon`
VALUES (
        575,
        'fa fa-reddit-square',
        'fa-reddit-square'
    );

INSERT INTO `mst_icon` VALUES ( 576, 'fa fa-renren', 'fa-renren' );

INSERT INTO
    `mst_icon`
VALUES (
        577,
        'fa fa-share-alt',
        'fa-share-alt'
    );

INSERT INTO
    `mst_icon`
VALUES (
        578,
        'fa fa-share-alt-square',
        'fa-share-alt-square'
    );

INSERT INTO `mst_icon` VALUES ( 579, 'fa fa-skype', 'fa-skype' );

INSERT INTO `mst_icon` VALUES ( 580, 'fa fa-slack', 'fa-slack' );

INSERT INTO
    `mst_icon`
VALUES (
        581,
        'fa fa-slideshare',
        'fa-slideshare'
    );

INSERT INTO
    `mst_icon`
VALUES (
        582,
        'fa fa-soundcloud',
        'fa-soundcloud'
    );

INSERT INTO `mst_icon` VALUES ( 583, 'fa fa-spotify', 'fa-spotify' );

INSERT INTO
    `mst_icon`
VALUES (
        584,
        'fa fa-stack-exchange',
        'fa-stack-exchange'
    );

INSERT INTO
    `mst_icon`
VALUES (
        585,
        'fa fa-stack-overflow',
        'fa-stack-overflow'
    );

INSERT INTO `mst_icon` VALUES ( 586, 'fa fa-steam', 'fa-steam' );

INSERT INTO
    `mst_icon`
VALUES (
        587,
        'fa fa-steam-square',
        'fa-steam-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        588,
        'fa fa-stumbleupon',
        'fa-stumbleupon'
    );

INSERT INTO
    `mst_icon`
VALUES (
        589,
        'fa fa-stumbleupon-circle',
        'fa-stumbleupon-circle'
    );

INSERT INTO
    `mst_icon`
VALUES (
        590,
        'fa fa-tencent-weibo',
        'fa-tencent-weibo'
    );

INSERT INTO `mst_icon` VALUES ( 591, 'fa fa-trello', 'fa-trello' );

INSERT INTO `mst_icon` VALUES ( 592, 'fa fa-tumblr', 'fa-tumblr' );

INSERT INTO
    `mst_icon`
VALUES (
        593,
        'fa fa-tumblr-square',
        'fa-tumblr-square'
    );

INSERT INTO `mst_icon` VALUES ( 594, 'fa fa-twitch', 'fa-twitch' );

INSERT INTO `mst_icon` VALUES ( 595, 'fa fa-twitter', 'fa-twitter' );

INSERT INTO
    `mst_icon`
VALUES (
        596,
        'fa fa-twitter-square',
        'fa-twitter-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        597,
        'fa fa-vimeo-square',
        'fa-vimeo-square'
    );

INSERT INTO `mst_icon` VALUES (598, 'fa fa-vine', 'fa-vine');

INSERT INTO `mst_icon` VALUES (599, 'fa fa-vk', 'fa-vk');

INSERT INTO `mst_icon` VALUES ( 600, 'fa fa-wechat', 'fa-wechat' );

INSERT INTO `mst_icon` VALUES ( 601, 'fa fa-weibo', 'fa-weibo' );

INSERT INTO `mst_icon` VALUES ( 602, 'fa fa-weixin', 'fa-weixin' );

INSERT INTO `mst_icon` VALUES ( 603, 'fa fa-windows', 'fa-windows' );

INSERT INTO
    `mst_icon`
VALUES (
        604,
        'fa fa-wordpress',
        'fa-wordpress'
    );

INSERT INTO `mst_icon` VALUES (605, 'fa fa-xing', 'fa-xing');

INSERT INTO
    `mst_icon`
VALUES (
        606,
        'fa fa-xing-square',
        'fa-xing-square'
    );

INSERT INTO `mst_icon` VALUES ( 607, 'fa fa-yahoo', 'fa-yahoo' );

INSERT INTO `mst_icon` VALUES (608, 'fa fa-yelp', 'fa-yelp');

INSERT INTO `mst_icon` VALUES ( 609, 'fa fa-youtube', 'fa-youtube' );

INSERT INTO
    `mst_icon`
VALUES (
        610,
        'fa fa-youtube-play',
        'fa-youtube-play'
    );

INSERT INTO
    `mst_icon`
VALUES (
        611,
        'fa fa-youtube-square',
        'fa-youtube-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        612,
        'fa fa-ambulance',
        'fa-ambulance'
    );

INSERT INTO
    `mst_icon`
VALUES (
        613,
        'fa fa-h-square',
        'fa-h-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        614,
        'fa fa-hospital-o',
        'fa-hospital-o'
    );

INSERT INTO `mst_icon` VALUES ( 615, 'fa fa-medkit', 'fa-medkit' );

INSERT INTO
    `mst_icon`
VALUES (
        616,
        'fa fa-plus-square',
        'fa-plus-square'
    );

INSERT INTO
    `mst_icon`
VALUES (
        617,
        'fa fa-stethoscope',
        'fa-stethoscope'
    );

INSERT INTO `mst_icon` VALUES ( 618, 'fa fa-user-md', 'fa-user-md' );

INSERT INTO
    `mst_icon`
VALUES (
        619,
        'fa fa-wheelchair',
        'fa-wheelchair'
    );

-- ----------------------------
-- Table structure for mst_item_status
-- ----------------------------
DROP TABLE IF EXISTS `mst_item_status`;

CREATE TABLE `mst_item_status` (
    `item_status_id` char(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `item_status_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `rules` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `no_loan` smallint NOT NULL DEFAULT 0,
    `skip_stock_take` smallint NOT NULL DEFAULT 0,
    `input_date` date NULL DEFAULT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`item_status_id`) USING BTREE,
    UNIQUE INDEX `item_status_name` (`item_status_name`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for mst_item_type
-- ----------------------------
DROP TABLE IF EXISTS `mst_item_type`;

CREATE TABLE `mst_item_type` (
    `item_type_id` int NOT NULL AUTO_INCREMENT,
    `item_type_code` varchar(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    `item_type_name` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    `input_date` date NULL DEFAULT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`item_type_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of mst_item_type
-- ----------------------------
INSERT INTO
    `mst_item_type`
VALUES (
        1,
        'BS',
        'Bachelor\'s Thesis',
        '2020-05-10',
        '2020-05-10'
    );

INSERT INTO
    `mst_item_type`
VALUES (
        3,
        'THS',
        'Master\'s Thesis',
        '2020-05-10',
        '2020-05-10'
    );

INSERT INTO
    `mst_item_type`
VALUES (
        5,
        'DSR',
        'Dissertation',
        '2020-05-15',
        '2020-05-15'
    );

INSERT INTO
    `mst_item_type`
VALUES (
        6,
        'OTH',
        'Other',
        '2020-06-10',
        '2020-06-10'
    );

-- ----------------------------
-- Table structure for mst_label
-- ----------------------------
DROP TABLE IF EXISTS `mst_label`;

CREATE TABLE `mst_label` (
    `label_id` int NOT NULL AUTO_INCREMENT,
    `label_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `label_desc` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `label_image` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `input_date` date NOT NULL,
    `last_update` date NOT NULL,
    PRIMARY KEY (`label_id`) USING BTREE,
    UNIQUE INDEX `label_name` (`label_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mst_label
-- ----------------------------

-- ----------------------------
-- Table structure for mst_language
-- ----------------------------
DROP TABLE IF EXISTS `mst_language`;

CREATE TABLE `mst_language` (
    `language_id` char(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `language_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `input_date` date NULL DEFAULT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`language_id`) USING BTREE,
    UNIQUE INDEX `language_name` (`language_name`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mst_language
-- ----------------------------
INSERT INTO
    `mst_language`
VALUES (
        'id',
        'Indonesia',
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_language`
VALUES (
        'en',
        'English',
        '2017-08-16',
        '2017-08-16'
    );

-- ----------------------------
-- Table structure for mst_license
-- ----------------------------
DROP TABLE IF EXISTS `mst_license`;

CREATE TABLE `mst_license` (
    `license_id` int NOT NULL AUTO_INCREMENT,
    `license_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `input_date` date NOT NULL,
    `last_update` date NOT NULL,
    PRIMARY KEY (`license_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of mst_license
-- ----------------------------

-- ----------------------------
-- Table structure for mst_loan_rules
-- ----------------------------
DROP TABLE IF EXISTS `mst_loan_rules`;

CREATE TABLE `mst_loan_rules` (
    `loan_rules_id` int NOT NULL AUTO_INCREMENT,
    `member_type_id` int NOT NULL DEFAULT 0,
    `coll_type_id` int NULL DEFAULT 0,
    `gmd_id` int NULL DEFAULT 0,
    `loan_limit` int NULL DEFAULT 0,
    `loan_periode` int NULL DEFAULT 0,
    `reborrow_limit` int NULL DEFAULT 0,
    `fine_each_day` int NULL DEFAULT 0,
    `grace_periode` int NULL DEFAULT 0,
    `input_date` date NULL DEFAULT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`loan_rules_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = FIXED;

-- ----------------------------
-- Records of mst_loan_rules
-- ----------------------------

-- ----------------------------
-- Table structure for mst_location
-- ----------------------------
DROP TABLE IF EXISTS `mst_location`;

CREATE TABLE `mst_location` (
    `location_id` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `location_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `input_date` date NOT NULL,
    `last_update` date NOT NULL,
    PRIMARY KEY (`location_id`) USING BTREE,
    UNIQUE INDEX `location_name` (`location_name`) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mst_location
-- ----------------------------

-- ----------------------------
-- Table structure for mst_member_type
-- ----------------------------
DROP TABLE IF EXISTS `mst_member_type`;

CREATE TABLE `mst_member_type` (
    `member_type_id` int NOT NULL AUTO_INCREMENT,
    `member_type_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `loan_limit` int NOT NULL,
    `loan_periode` int NOT NULL,
    `enable_reserve` int NOT NULL DEFAULT 0,
    `reserve_limit` int NOT NULL DEFAULT 0,
    `member_periode` int NOT NULL,
    `reborrow_limit` int NOT NULL,
    `fine_each_day` int NOT NULL,
    `grace_periode` int NULL DEFAULT 0,
    `input_date` date NOT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`member_type_id`) USING BTREE,
    UNIQUE INDEX `member_type_name` (`member_type_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mst_member_type
-- ----------------------------

-- ----------------------------
-- Table structure for mst_menu
-- ----------------------------
DROP TABLE IF EXISTS `mst_menu`;

CREATE TABLE `mst_menu` (
    `id` int NOT NULL AUTO_INCREMENT,
    `parent_id` int NULL DEFAULT NULL,
    `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `url` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    `icon` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    `type` enum('menu', 'submenu', 'title') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `level` int NOT NULL,
    `desc` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL,
    PRIMARY KEY (`id`) USING BTREE,
    INDEX `parent_id` (`parent_id` ASC) USING BTREE,
    CONSTRAINT `mst_menu_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `mst_menu` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of mst_menu
-- ----------------------------
INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        NULL,
        'Pinned',
        NULL,
        'fa-thumb-tack',
        'menu',
        1,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        1,
        'Update User Profile',
        'profile',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        NULL,
        'Dashboard',
        'home',
        'fa-bar-chart-o',
        'menu',
        1,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        NULL,
        'Opac',
        'opac',
        'fa-desktop',
        'menu',
        1,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        NULL,
        'ETD',
        NULL,
        'fa-book',
        'menu',
        1,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        5,
        'Bibliography',
        '#',
        NULL,
        'title',
        2,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        6,
        'Etd List',
        'bibliography',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        NULL,
        'Membership',
        NULL,
        'fa-user',
        'menu',
        1,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        8,
        'Membership',
        NULL,
        NULL,
        'title',
        2,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        9,
        'List Membership',
        'membership',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        9,
        'Member Type',
        'membership/membertype',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        NULL,
        'Master File',
        NULL,
        'fa-file',
        'menu',
        1,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        12,
        'List Controlled',
        NULL,
        NULL,
        'title',
        2,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        13,
        'GMD',
        'master/gmd',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        13,
        'Publisher',
        'master/penerbit',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        13,
        'Writer',
        'master/pengarang',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        13,
        'Supervisor',
        'master/supervisor',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        13,
        'Examiner',
        'master/examiner',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        13,
        'Location',
        'master/location',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        12,
        'References',
        NULL,
        NULL,
        'title',
        2,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        20,
        'Places',
        'master/place',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        20,
        'Exemplar State',
        'master/statusitem',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        20,
        'Collection Type',
        'master/collection',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        20,
        'Language',
        'master/language',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        20,
        'Frequency',
        'master/frequency',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        12,
        'License',
        'master/license',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        12,
        'Code Ministry PDDIKTI',
        'master/codeministry',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        12,
        'Subject',
        'master/subject',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        NULL,
        'System',
        NULL,
        'fa-sitemap',
        'menu',
        1,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        28,
        'System',
        NULL,
        NULL,
        'title',
        2,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        29,
        'System Configuration',
        'sistem/pengaturan-sistem',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        29,
        'Content',
        'sistem/konten',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        29,
        'Shortcut',
        'sistem/pintasan',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        29,
        'Biblio Index',
        'sistem/indeks-biblio',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        29,
        'Modules',
        'sistem/modul',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        29,
        'Libarian System',
        'sistem/pustakawan',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        29,
        'User Groups',
        'sistem/user-groups',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        29,
        'Format Scan Generator',
        '',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        29,
        'Sys Log',
        'sistem/logs',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        29,
        'Backup Data',
        'sistem/backups',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        NULL,
        'Reporting',
        NULL,
        'fa-table',
        'menu',
        1,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        40,
        'Reporting',
        NULL,
        NULL,
        'title',
        2,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        41,
        'Statistic Collection',
        'report/stats-collection',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        41,
        'Membership Report',
        'report/membership',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        40,
        'Other Report',
        NULL,
        NULL,
        'title',
        2,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        44,
        'Recapitulation',
        'report/recap',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        44,
        'List Title',
        'report/titles',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        44,
        'List Membership',
        'report/list-member',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        44,
        'Contributor List',
        'report/contributors',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        44,
        'Staff Activity',
        'report/staff-activity',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        44,
        'Visitor',
        'report/visitor',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        44,
        'Visualize Diagram',
        '#',
        NULL,
        'submenu',
        3,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        NULL,
        'Logout',
        'logout',
        'fa-power-off',
        'menu',
        1,
        NULL
    );

INSERT INTO
    mst_menu (
        parent_id,
        title,
        url,
        icon,
        `type`,
        `level`,
        `desc`
    )
VALUES (
        41,
        'Download Counter',
        'report/download-counter',
        NULL,
        'submenu',
        3,
        NULL
    );

-- ----------------------------
-- Table structure for mst_module
-- ----------------------------
DROP TABLE IF EXISTS `mst_module`;

CREATE TABLE `mst_module` (
    `module_id` int NOT NULL AUTO_INCREMENT,
    `module_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `module_path` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `module_desc` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    PRIMARY KEY (`module_id`) USING BTREE,
    UNIQUE INDEX `module_name` (`module_name`, `module_path`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 9 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mst_module
-- ----------------------------
INSERT INTO
    `mst_module`
VALUES (
        1,
        'ETD',
        'bibliography',
        'Manage your bibliographic/catalog and items/copies database'
    );

INSERT INTO
    `mst_module`
VALUES (
        3,
        'membership',
        'membership',
        'Manage your library membership and membership type'
    );

INSERT INTO
    `mst_module`
VALUES (
        4,
        'master_file',
        'master_file',
        'Manage your referential data that will be used by other modules'
    );

INSERT INTO
    `mst_module`
VALUES (
        6,
        'system',
        'system',
        'Configure system behaviour, user and backups'
    );

INSERT INTO
    `mst_module`
VALUES (
        7,
        'reporting',
        'reporting',
        'Real time and dynamic report about library collections and circulation'
    );

-- ----------------------------
-- Table structure for mst_place
-- ----------------------------
DROP TABLE IF EXISTS `mst_place`;

CREATE TABLE `mst_place` (
    `place_id` int NOT NULL AUTO_INCREMENT,
    `place_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `input_date` date NULL DEFAULT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`place_id`) USING BTREE,
    UNIQUE INDEX `place_name` (`place_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mst_place
-- ----------------------------

-- ----------------------------
-- Table structure for mst_publisher
-- ----------------------------
DROP TABLE IF EXISTS `mst_publisher`;

CREATE TABLE `mst_publisher` (
    `publisher_id` int NOT NULL AUTO_INCREMENT,
    `publisher_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `input_date` date NULL DEFAULT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`publisher_id`) USING BTREE,
    UNIQUE INDEX `publisher_name` (`publisher_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mst_publisher
-- ----------------------------

-- ----------------------------
-- Table structure for mst_supervisor
-- ----------------------------
DROP TABLE IF EXISTS `mst_supervisor`;

CREATE TABLE `mst_supervisor` (
    `supervisor_id` int NOT NULL AUTO_INCREMENT,
    `supervisor_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    `supervisor_number` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `supervisor_year` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    `supervisor_type` enum('p', 'o', 'c') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    `supervisor_list` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
    `input_date` date NOT NULL,
    `last_update` date NOT NULL,
    PRIMARY KEY (`supervisor_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = COMPACT;

-- ----------------------------
-- Records of mst_supervisor
-- ----------------------------

-- ----------------------------
-- Table structure for mst_supplier
-- ----------------------------
DROP TABLE IF EXISTS `mst_supplier`;

CREATE TABLE `mst_supplier` (
    `supplier_id` int NOT NULL AUTO_INCREMENT,
    `supplier_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `address` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `postal_code` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `phone` char(14) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `contact` char(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `fax` char(14) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `account` char(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `e_mail` char(80) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `input_date` date NULL DEFAULT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`supplier_id`) USING BTREE,
    UNIQUE INDEX `supplier_name` (`supplier_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mst_supplier
-- ----------------------------

-- ----------------------------
-- Table structure for mst_topic
-- ----------------------------
DROP TABLE IF EXISTS `mst_topic`;

CREATE TABLE `mst_topic` (
    `topic_id` int NOT NULL AUTO_INCREMENT,
    `topic` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `topic_type` enum(
        't',
        'g',
        'n',
        'tm',
        'gr',
        'oc'
    ) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `auth_list` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `classification` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'Classification Code',
    `input_date` date NULL DEFAULT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`topic_id`) USING BTREE,
    UNIQUE INDEX `topic` (`topic`, `topic_type`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of mst_topic
-- ----------------------------

-- ----------------------------
-- Table structure for reserve
-- ----------------------------
DROP TABLE IF EXISTS `reserve`;

CREATE TABLE `reserve` (
    `reserve_id` int NOT NULL AUTO_INCREMENT,
    `member_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `biblio_id` int NOT NULL,
    `item_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `reserve_date` datetime NOT NULL,
    PRIMARY KEY (`reserve_id`) USING BTREE,
    INDEX `references_idx` (`member_id`, `biblio_id`) USING BTREE,
    INDEX `item_code_idx` (`item_code`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of reserve
-- ----------------------------

-- ----------------------------
-- Table structure for search_biblio
-- ----------------------------
DROP TABLE IF EXISTS `search_biblio`;

CREATE TABLE `search_biblio` (
    `biblio_id` int(11) NOT NULL,
    `title` text COLLATE utf8_unicode_ci,
    `edition` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
    `isbn_issn` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
    `author` text COLLATE utf8_unicode_ci,
    `examiner` text COLLATE utf8_unicode_ci,
    `supervisor` text COLLATE utf8_unicode_ci,
    `contributor` text COLLATE utf8_unicode_ci,
    `topic` text COLLATE utf8_unicode_ci,
    `gmd` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
    `publisher` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
    `publish_place` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
    `language` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
    `classification` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
    `spec_detail_info` text COLLATE utf8_unicode_ci,
    `location` text COLLATE utf8_unicode_ci,
    `publish_year` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
    `notes` text COLLATE utf8_unicode_ci,
    `series_title` text COLLATE utf8_unicode_ci,
    `items` text COLLATE utf8_unicode_ci,
    `collection_types` text COLLATE utf8_unicode_ci,
    `call_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
    `opac_hide` smallint(1) NOT NULL DEFAULT '0',
    `promoted` smallint(1) NOT NULL DEFAULT '0',
    `labels` text COLLATE utf8_unicode_ci,
    `collation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
    `image` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
    `input_date` datetime DEFAULT NULL,
    `last_update` datetime DEFAULT NULL,
    UNIQUE KEY `biblio_id` (`biblio_id`),
    KEY `add_indexes` (
        `gmd`,
        `publisher`,
        `publish_place`,
        `language`,
        `classification`,
        `publish_year`,
        `call_number`
    ),
    KEY `add_indexes2` (`opac_hide`, `promoted`),
    FULLTEXT KEY `title` (`title`),
    FULLTEXT KEY `author` (`author`),
    FULLTEXT KEY `topic` (`topic`),
    FULLTEXT KEY `location` (`location`),
    FULLTEXT KEY `items` (`items`),
    FULLTEXT KEY `collection_types` (`collection_types`),
    FULLTEXT KEY `labels` (`labels`),
    FULLTEXT KEY `supervisor` (`supervisor`),
    FULLTEXT KEY `contributor` (`contributor`),
    FULLTEXT KEY `examiner` (`examiner`)
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_unicode_ci COMMENT = 'index table for advance searching technique for SLiMS' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of search_biblio
-- ----------------------------

-- ----------------------------
-- Table structure for serial
-- ----------------------------
DROP TABLE IF EXISTS `serial`;

CREATE TABLE `serial` (
    `serial_id` int NOT NULL AUTO_INCREMENT,
    `date_start` date NOT NULL,
    `date_end` date NULL DEFAULT NULL,
    `period` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `notes` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `biblio_id` int NULL DEFAULT NULL,
    `gmd_id` int NULL DEFAULT NULL,
    `input_date` date NOT NULL,
    `last_update` date NOT NULL,
    PRIMARY KEY (`serial_id`) USING BTREE,
    INDEX `fk_serial_biblio` (`biblio_id`) USING BTREE,
    INDEX `fk_serial_gmd` (`gmd_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of serial
-- ----------------------------

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;

CREATE TABLE `setting` (
    `setting_id` int NOT NULL AUTO_INCREMENT,
    `setting_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `setting_value` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    PRIMARY KEY (`setting_id`) USING BTREE,
    UNIQUE INDEX `setting_name` (`setting_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 71 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for stock_take
-- ----------------------------
DROP TABLE IF EXISTS `stock_take`;

CREATE TABLE `stock_take` (
    `stock_take_id` int NOT NULL AUTO_INCREMENT,
    `stock_take_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `start_date` datetime NOT NULL,
    `end_date` datetime NULL DEFAULT NULL,
    `init_user` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `total_item_stock_taked` int NULL DEFAULT NULL,
    `total_item_lost` int NULL DEFAULT NULL,
    `total_item_exists` int NULL DEFAULT 0,
    `total_item_loan` int NULL DEFAULT NULL,
    `stock_take_users` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `is_active` int NOT NULL DEFAULT 0,
    `report_file` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    PRIMARY KEY (`stock_take_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of stock_take
-- ----------------------------

-- ----------------------------
-- Table structure for stock_take_item
-- ----------------------------
DROP TABLE IF EXISTS `stock_take_item`;

CREATE TABLE `stock_take_item` (
    `stock_take_id` int NOT NULL,
    `item_id` int NOT NULL,
    `item_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `gmd_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `classification` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `coll_type_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `call_number` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `location` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `status` enum('e', 'm', 'u', 'l') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'm',
    `checked_by` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `last_update` datetime NULL DEFAULT NULL,
    PRIMARY KEY (`stock_take_id`, `item_id`) USING BTREE,
    UNIQUE INDEX `item_code` (`item_code`) USING BTREE,
    INDEX `status` (`status`) USING BTREE,
    INDEX `item_properties_idx` (
        `gmd_name`,
        `classification`,
        `coll_type_name`,
        `location`
    ) USING BTREE
) ENGINE = MyISAM CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of stock_take_item
-- ----------------------------

-- ----------------------------
-- Table structure for system_log
-- ----------------------------
DROP TABLE IF EXISTS `system_log`;

CREATE TABLE `system_log` (
    `log_id` int NOT NULL AUTO_INCREMENT,
    `log_type` enum('staff', 'member', 'system') CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT 'staff',
    `id` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `log_location` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `log_msg` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `log_date` datetime NOT NULL,
    PRIMARY KEY (`log_id`) USING BTREE,
    INDEX `log_type` (`log_type`) USING BTREE,
    INDEX `id` (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of system_log
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
    `user_id` int NOT NULL AUTO_INCREMENT,
    `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `realname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `passwd` varchar(64) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `email` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `user_type` smallint NULL DEFAULT NULL,
    `user_image` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `social_media` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL,
    `last_login` datetime NULL DEFAULT NULL,
    `last_login_ip` char(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `groups` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `input_date` date NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`user_id`) USING BTREE,
    UNIQUE INDEX `username` (`username`) USING BTREE,
    INDEX `realname` (`realname`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Table structure for user_group
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;

CREATE TABLE `user_group` (
    `group_id` int NOT NULL AUTO_INCREMENT,
    `group_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `input_date` date NULL DEFAULT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`group_id`) USING BTREE,
    UNIQUE INDEX `group_name` (`group_name`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of user_group
-- ----------------------------
INSERT INTO
    `user_group`
VALUES (
        1,
        'Administrator',
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `user_group`
VALUES (
        2,
        'admin',
        '2017-11-12',
        '2017-11-12'
    );

INSERT INTO
    `user_group`
VALUES (
        3,
        'Operator',
        '2020-05-15',
        '2020-05-15'
    );

INSERT INTO
    `user_group`
VALUES (
        4,
        'User',
        '2020-05-15',
        '2020-05-15'
    );

-- ----------------------------
-- Table structure for visitor_count
-- ----------------------------
DROP TABLE IF EXISTS `visitor_count`;

CREATE TABLE `visitor_count` (
    `visitor_id` int NOT NULL AUTO_INCREMENT,
    `member_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `member_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `institution` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `checkin_date` datetime NOT NULL,
    PRIMARY KEY (`visitor_id`) USING BTREE,
    INDEX `member_id` (`member_id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of visitor_count
-- ----------------------------

ALTER TABLE mst_author
ADD COLUMN IF NOT EXISTS orcid_id VARCHAR(50) NULL AFTER auth_list;

DROP TABLE IF EXISTS `mst_gmd`;

CREATE TABLE `mst_gmd` (
    `gmd_id` int NOT NULL AUTO_INCREMENT,
    `gmd_code` varchar(3) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `gmd_name` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
    `icon_image` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
    `input_date` date NOT NULL,
    `last_update` date NULL DEFAULT NULL,
    PRIMARY KEY (`gmd_id`) USING BTREE,
    UNIQUE INDEX `gmd_name` (`gmd_name`) USING BTREE,
    UNIQUE INDEX `gmd_code` (`gmd_code`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 46 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mst_gmd
-- ----------------------------
INSERT INTO
    `mst_gmd`
VALUES (
        1,
        'TE',
        'Text',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        2,
        'AR',
        'Art Original',
        NULL,
        '2017-08-16',
        '2018-03-20'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        3,
        'CH',
        'Chart',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        4,
        'CO',
        'Computer Software',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        5,
        'DI',
        'Diorama',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        6,
        'FI',
        'Filmstrip',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        7,
        'FL',
        'Flash Card',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        8,
        'GA',
        'Game',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        9,
        'GL',
        'Globe',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        10,
        'KI',
        'Kit',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        11,
        'MA',
        'Map',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        12,
        'MI',
        'Microform',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        13,
        'MN',
        'Manuscript',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        14,
        'MO',
        'Model',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        15,
        'MP',
        'Motion Picture',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        16,
        'MS',
        'Microscope Slide',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        17,
        'MU',
        'Music',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        18,
        'PI',
        'Picture',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        19,
        'RE',
        'Realia',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        20,
        'SL',
        'Slide',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        21,
        'SO',
        'Sound Recording',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        22,
        'TD',
        'Technical Drawing',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        23,
        'TR',
        'Transparency',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        24,
        'VI',
        'Video Recording',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        25,
        'EQ',
        'Equipment',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        26,
        'CF',
        'Computer File',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        27,
        'CA',
        'Cartographic Material',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        28,
        'CD',
        'CD-ROM',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        29,
        'MV',
        'Multimedia',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        30,
        'ER',
        'Electronic Resource',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        31,
        'DVD',
        'Digital Versatile Disc',
        NULL,
        '2017-08-16',
        '2017-08-16'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        0,
        NULL,
        'Mainan',
        NULL,
        '2018-03-23',
        '2018-03-23'
    );

INSERT INTO
    `mst_gmd`
VALUES (
        43,
        'SK',
        'Skripsi',
        NULL,
        '2020-07-26',
        '2020-07-26'
    );

DROP TABLE IF EXISTS `mst_copyright`;

CREATE TABLE `mst_copyright` (
    `copyright_id` int NOT NULL AUTO_INCREMENT,
    `copyright_name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    `input_date` date NOT NULL,
    `last_update` date NOT NULL,
    PRIMARY KEY (`copyright_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mst_copyright
-- ----------------------------
INSERT INTO
    `mst_copyright`
VALUES (
        1,
        'Lembaga Penerbit',
        '2019-03-14',
        '2019-03-14'
    );

INSERT INTO
    `mst_copyright`
VALUES (
        2,
        'Individu Penulis',
        '2020-05-18',
        '2020-05-18'
    );

INSERT INTO
    `mst_copyright`
VALUES (
        3,
        'Sekolah Tinggi Ilmu Kesehatan Holistik',
        '2020-07-26',
        '2020-07-26'
    );

INSERT INTO
    `mst_copyright`
VALUES (
        4,
        'Institut Teknologi Nasional Bandung',
        '2020-07-29',
        '2020-07-29'
    );

SET FOREIGN_KEY_CHECKS = 1;

insert into
    group_access (group_id, module_id, r, w)
select 1, id, 1, 1
FROM mst_menu
where
    id NOT IN(
        SELECT module_id
        FROM group_access
        where
            group_id = 1
    );


-- ----------------------------
-- Table structure for biblio
-- ----------------------------
DROP TABLE IF EXISTS `biblio_count`;

CREATE TABLE `biblio_count` (
  `biblio_id` int NOT NULL,
  `file_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `biblio_id` (`biblio_id`) USING BTREE,
  KEY `biblio_id_2` (`biblio_id`,`file_id`) USING BTREE,
  KEY `file_id` (`file_id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
