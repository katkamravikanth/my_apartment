<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240903052658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `admin` (id INT AUTO_INCREMENT NOT NULL, branch_id INT NOT NULL, name VARCHAR(180) NOT NULL, contact VARCHAR(25) DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), UNIQUE INDEX UNIQ_880E0D76DCD6CC49 (branch_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE branch (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, contact_no VARCHAR(25) NOT NULL, address VARCHAR(255) NOT NULL, security_guard_mobile VARCHAR(25) DEFAULT NULL, secretary_mobile VARCHAR(25) DEFAULT NULL, moderator_mobile VARCHAR(25) DEFAULT NULL, building_make_year VARCHAR(25) DEFAULT NULL, building_image VARCHAR(255) DEFAULT NULL, status SMALLINT NOT NULL, builder_company_name VARCHAR(255) DEFAULT NULL, builder_company_phone VARCHAR(25) DEFAULT NULL, builder_company_address VARCHAR(255) DEFAULT NULL, building_rule LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE employee (id INT AUTO_INCREMENT NOT NULL, designation_id INT DEFAULT NULL, branch_id INT DEFAULT NULL, name VARCHAR(180) NOT NULL, contact VARCHAR(25) DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, present_address VARCHAR(255) NOT NULL, permanent_address VARCHAR(255) NOT NULL, aadhaar_no VARCHAR(20) DEFAULT NULL, joining_date DATE NOT NULL, ending_date DATE DEFAULT NULL, status SMALLINT NOT NULL, image VARCHAR(255) DEFAULT NULL, salary NUMERIC(15, 2) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_5D9F75A1E7927C74 (email), UNIQUE INDEX UNIQ_5D9F75A1FAC7D83F (designation_id), UNIQUE INDEX UNIQ_5D9F75A1DCD6CC49 (branch_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member_type (id INT AUTO_INCREMENT NOT NULL, member_type VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE owner (id INT AUTO_INCREMENT NOT NULL, branch_id INT DEFAULT NULL, name VARCHAR(180) NOT NULL, contact VARCHAR(25) DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, present_address VARCHAR(255) NOT NULL, permanent_address VARCHAR(255) NOT NULL, aadhaar_no VARCHAR(20) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_CF60E67CE7927C74 (email), UNIQUE INDEX UNIQ_CF60E67CDCD6CC49 (branch_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE super_admin (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(180) NOT NULL, contact VARCHAR(25) DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_BC8C2783E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tenant (id INT AUTO_INCREMENT NOT NULL, branch_id INT NOT NULL, name VARCHAR(180) NOT NULL, contact VARCHAR(25) DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, aadhaar_no VARCHAR(20) DEFAULT NULL, floor_no VARCHAR(10) NOT NULL, unit_no VARCHAR(10) NOT NULL, advance_rent NUMERIC(15, 2) NOT NULL, rent_per_month NUMERIC(15, 2) NOT NULL, issue_date DATE NOT NULL, exit_date DATE DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, status SMALLINT NOT NULL, month INT NOT NULL, year INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', deleted_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_4E59C462E7927C74 (email), INDEX IDX_4E59C462DCD6CC49 (branch_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `admin` ADD CONSTRAINT FK_880E0D76DCD6CC49 FOREIGN KEY (branch_id) REFERENCES branch (id)');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1FAC7D83F FOREIGN KEY (designation_id) REFERENCES member_type (id)');
        $this->addSql('ALTER TABLE employee ADD CONSTRAINT FK_5D9F75A1DCD6CC49 FOREIGN KEY (branch_id) REFERENCES branch (id)');
        $this->addSql('ALTER TABLE owner ADD CONSTRAINT FK_CF60E67CDCD6CC49 FOREIGN KEY (branch_id) REFERENCES branch (id)');
        $this->addSql('ALTER TABLE tenant ADD CONSTRAINT FK_4E59C462DCD6CC49 FOREIGN KEY (branch_id) REFERENCES branch (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `admin` DROP FOREIGN KEY FK_880E0D76DCD6CC49');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1FAC7D83F');
        $this->addSql('ALTER TABLE employee DROP FOREIGN KEY FK_5D9F75A1DCD6CC49');
        $this->addSql('ALTER TABLE owner DROP FOREIGN KEY FK_CF60E67CDCD6CC49');
        $this->addSql('ALTER TABLE tenant DROP FOREIGN KEY FK_4E59C462DCD6CC49');
        $this->addSql('DROP TABLE `admin`');
        $this->addSql('DROP TABLE branch');
        $this->addSql('DROP TABLE employee');
        $this->addSql('DROP TABLE member_type');
        $this->addSql('DROP TABLE owner');
        $this->addSql('DROP TABLE super_admin');
        $this->addSql('DROP TABLE tenant');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
