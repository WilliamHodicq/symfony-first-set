<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211203085132 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD COLUMN surface INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD COLUMN rooms INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD COLUMN bedrooms INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD COLUMN floor INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD COLUMN price INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD COLUMN heat INTEGER DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD COLUMN city VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD COLUMN adress VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD COLUMN postal_code VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE property ADD COLUMN sold BOOLEAN DEFAULT \'0\'');
        $this->addSql('ALTER TABLE property ADD COLUMN created_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__property AS SELECT id, title, description FROM property');
        $this->addSql('DROP TABLE property');
        $this->addSql('CREATE TABLE property (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL)');
        $this->addSql('INSERT INTO property (id, title, description) SELECT id, title, description FROM __temp__property');
        $this->addSql('DROP TABLE __temp__property');
    }
}
