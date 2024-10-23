<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241023202029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // Establecer un valor por defecto para la columna `fecha_envio`
        $this->addSql('ALTER TABLE contacto CHANGE fecha_envio fecha_envio DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP');
        $this->addSql('ALTER TABLE contacto DROP area_id');
    }


    public function down(Schema $schema): void
    {
        // Este método debe restaurar el estado anterior
        $this->addSql('ALTER TABLE contacto ADD area_id INT NOT NULL');
        $this->addSql('ALTER TABLE contacto CHANGE fecha_envio fecha_envio DATETIME DEFAULT CURRENT_TIMESTAMP');
    }

}
