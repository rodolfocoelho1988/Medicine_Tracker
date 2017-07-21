<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170718203733 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE MedInfo (id INT AUTO_INCREMENT NOT NULL, medicine_id INT DEFAULT NULL, preparedOn DATE NOT NULL, numBlisters INT NOT NULL, deliveryPickupDate DATE NOT NULL, nextDueDate DATE NOT NULL, isActive TINYINT(1) NOT NULL, INDEX IDX_C6C4C5D62F7D140A (medicine_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE Patient (id INT AUTO_INCREMENT NOT NULL, Name VARCHAR(255) NOT NULL, isActive TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE MedInfo ADD CONSTRAINT FK_C6C4C5D62F7D140A FOREIGN KEY (medicine_id) REFERENCES Patient (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE MedInfo DROP FOREIGN KEY FK_C6C4C5D62F7D140A');
        $this->addSql('DROP TABLE MedInfo');
        $this->addSql('DROP TABLE Patient');
    }
}
