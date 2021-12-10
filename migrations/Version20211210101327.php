<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211210101327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX IDX_24F16FCCA7C41D6F');
        $this->addSql('DROP INDEX IDX_24F16FCC549213EC');
        $this->addSql('CREATE TEMPORARY TABLE __temp__property_option AS SELECT property_id, option_id FROM property_option');
        $this->addSql('DROP TABLE property_option');
        $this->addSql('CREATE TABLE property_option (property_id INTEGER NOT NULL, option_id INTEGER NOT NULL, PRIMARY KEY(property_id, option_id), CONSTRAINT FK_24F16FCC549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_24F16FCCA7C41D6F FOREIGN KEY (option_id) REFERENCES option (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO property_option (property_id, option_id) SELECT property_id, option_id FROM __temp__property_option');
        $this->addSql('DROP TABLE __temp__property_option');
        $this->addSql('CREATE INDEX IDX_24F16FCCA7C41D6F ON property_option (option_id)');
        $this->addSql('CREATE INDEX IDX_24F16FCC549213EC ON property_option (property_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
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
