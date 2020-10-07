<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201007190504 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE global_property_attribute DROP FOREIGN KEY FK_A3A9722E3256915B');
        $this->addSql('DROP INDEX IDX_A3A9722E3256915B ON global_property_attribute');
        $this->addSql('ALTER TABLE global_property_attribute CHANGE relation_id users_id INT NOT NULL');
        $this->addSql('ALTER TABLE global_property_attribute ADD CONSTRAINT FK_A3A9722E67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_A3A9722E67B3B43D ON global_property_attribute (users_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE global_property_attribute DROP FOREIGN KEY FK_A3A9722E67B3B43D');
        $this->addSql('DROP INDEX IDX_A3A9722E67B3B43D ON global_property_attribute');
        $this->addSql('ALTER TABLE global_property_attribute CHANGE users_id relation_id INT NOT NULL');
        $this->addSql('ALTER TABLE global_property_attribute ADD CONSTRAINT FK_A3A9722E3256915B FOREIGN KEY (relation_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A3A9722E3256915B ON global_property_attribute (relation_id)');
    }
}
