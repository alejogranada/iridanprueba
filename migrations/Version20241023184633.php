<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241023184633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contacto_area (contacto_id INT NOT NULL, area_contacto_id INT NOT NULL, INDEX IDX_A3E15AD16B505CA9 (contacto_id), INDEX IDX_A3E15AD1406BF6D9 (area_contacto_id), PRIMARY KEY(contacto_id, area_contacto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE contacto_area ADD CONSTRAINT FK_A3E15AD16B505CA9 FOREIGN KEY (contacto_id) REFERENCES contacto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contacto_area ADD CONSTRAINT FK_A3E15AD1406BF6D9 FOREIGN KEY (area_contacto_id) REFERENCES area_contacto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contacto DROP FOREIGN KEY FK_2741493CBD0F409C');
        $this->addSql('DROP INDEX IDX_2741493CBD0F409C ON contacto');        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contacto_area DROP FOREIGN KEY FK_A3E15AD16B505CA9');
        $this->addSql('ALTER TABLE contacto_area DROP FOREIGN KEY FK_A3E15AD1406BF6D9');
        $this->addSql('DROP TABLE contacto_area');
        $this->addSql('ALTER TABLE contacto ADD area_id INT NOT NULL, CHANGE fecha_envio fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE contacto ADD CONSTRAINT FK_2741493CBD0F409C FOREIGN KEY (area_id) REFERENCES area_contacto (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_2741493CBD0F409C ON contacto (area_id)');
    }
}
