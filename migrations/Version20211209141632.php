<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211209141632 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE option (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE property_option (property_id INTEGER NOT NULL, option_id INTEGER NOT NULL, PRIMARY KEY(property_id, option_id))');
        $this->addSql('CREATE INDEX IDX_24F16FCC549213EC ON property_option (property_id)');
        $this->addSql('CREATE INDEX IDX_24F16FCCA7C41D6F ON property_option (option_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE option');
        $this->addSql('DROP TABLE property_option');
    }
}
