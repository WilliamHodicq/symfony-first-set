<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211210095711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE property ADD COLUMN updated_at DATETIME DEFAULT NULL');
        $this->addSql('DROP INDEX IDX_24F16FCC549213EC');
        $this->addSql('DROP INDEX IDX_24F16FCCA7C41D6F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__property_option AS SELECT property_id, option_id FROM property_option');
        $this->addSql('DROP TABLE property_option');
        $this->addSql('CREATE TABLE property_option (property_id INTEGER NOT NULL, option_id INTEGER NOT NULL, PRIMARY KEY(property_id, option_id), CONSTRAINT FK_24F16FCC549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_24F16FCCA7C41D6F FOREIGN KEY (option_id) REFERENCES option (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO property_option (property_id, option_id) SELECT property_id, option_id FROM __temp__property_option');
        $this->addSql('DROP TABLE __temp__property_option');
        $this->addSql('CREATE INDEX IDX_24F16FCC549213EC ON property_option (property_id)');
        $this->addSql('CREATE INDEX IDX_24F16FCCA7C41D6F ON property_option (option_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__property AS SELECT id, filename, title, description, surface, rooms, bedrooms, floor, price, heat, city, adress, postal_code, sold, created_at FROM property');
        $this->addSql('DROP TABLE property');
        $this->addSql('CREATE TABLE property (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, filename VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, surface INTEGER DEFAULT NULL, rooms INTEGER DEFAULT NULL, bedrooms INTEGER DEFAULT NULL, floor INTEGER DEFAULT NULL, price INTEGER DEFAULT NULL, heat INTEGER DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, sold BOOLEAN DEFAULT \'0\', created_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO property (id, filename, title, description, surface, rooms, bedrooms, floor, price, heat, city, adress, postal_code, sold, created_at) SELECT id, filename, title, description, surface, rooms, bedrooms, floor, price, heat, city, adress, postal_code, sold, created_at FROM __temp__property');
        $this->addSql('DROP TABLE __temp__property');
        $this->addSql('DROP INDEX IDX_24F16FCC549213EC');
        $this->addSql('DROP INDEX IDX_24F16FCCA7C41D6F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__property_option AS SELECT property_id, option_id FROM property_option');
        $this->addSql('DROP TABLE property_option');
        $this->addSql('CREATE TABLE property_option (property_id INTEGER NOT NULL, option_id INTEGER NOT NULL, PRIMARY KEY(property_id, option_id))');
        $this->addSql('INSERT INTO property_option (property_id, option_id) SELECT property_id, option_id FROM __temp__property_option');
        $this->addSql('DROP TABLE __temp__property_option');
        $this->addSql('CREATE INDEX IDX_24F16FCC549213EC ON property_option (property_id)');
        $this->addSql('CREATE INDEX IDX_24F16FCCA7C41D6F ON property_option (option_id)');
    }
}
