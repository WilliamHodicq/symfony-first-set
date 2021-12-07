<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211207153742 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__property AS SELECT id, title, description, surface, rooms, bedrooms, floor, price, heat, city, adress, postal_code, sold, created_at FROM property');
        $this->addSql('DROP TABLE property');
        $this->addSql('CREATE TABLE property (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL COLLATE BINARY, description CLOB DEFAULT NULL COLLATE BINARY, surface INTEGER DEFAULT NULL, rooms INTEGER DEFAULT NULL, bedrooms INTEGER DEFAULT NULL, floor INTEGER DEFAULT NULL, price INTEGER DEFAULT NULL, heat INTEGER DEFAULT NULL, city VARCHAR(255) DEFAULT NULL COLLATE BINARY, adress VARCHAR(255) DEFAULT NULL COLLATE BINARY, postal_code VARCHAR(255) DEFAULT NULL COLLATE BINARY, sold BOOLEAN DEFAULT \'0\', created_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('INSERT INTO property (id, title, description, surface, rooms, bedrooms, floor, price, heat, city, adress, postal_code, sold, created_at) SELECT id, title, description, surface, rooms, bedrooms, floor, price, heat, city, adress, postal_code, sold, created_at FROM __temp__property');
        $this->addSql('DROP TABLE __temp__property');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('CREATE TEMPORARY TABLE __temp__property AS SELECT id, title, description, surface, rooms, bedrooms, floor, price, heat, city, adress, postal_code, sold, created_at FROM property');
        $this->addSql('DROP TABLE property');
        $this->addSql('CREATE TABLE property (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, title VARCHAR(255) NOT NULL, description CLOB DEFAULT NULL, surface INTEGER DEFAULT NULL, rooms INTEGER DEFAULT NULL, bedrooms INTEGER DEFAULT NULL, floor INTEGER DEFAULT NULL, price INTEGER DEFAULT NULL, heat INTEGER DEFAULT NULL, city VARCHAR(255) DEFAULT NULL, adress VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(255) DEFAULT NULL, sold BOOLEAN DEFAULT \'0\', created_at DATETIME DEFAULT NULL)');
        $this->addSql('INSERT INTO property (id, title, description, surface, rooms, bedrooms, floor, price, heat, city, adress, postal_code, sold, created_at) SELECT id, title, description, surface, rooms, bedrooms, floor, price, heat, city, adress, postal_code, sold, created_at FROM __temp__property');
        $this->addSql('DROP TABLE __temp__property');
    }
}
