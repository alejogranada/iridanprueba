<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241016025847 extends AbstractMigration
{
	public function getDescription(): string
    {
        return 'Añadir la columna fecha_envio a la tabla contacto';
    }

    public function up(Schema $schema): void
    {
        // Agregar la columna fecha_envio como nullable inicialmente
        //$this->addSql("ALTER TABLE contacto ADD fecha_envio DATETIME DEFAULT NULL");
    }

    public function down(Schema $schema): void
    {
        // Eliminar la columna fecha_envio
        $this->addSql("ALTER TABLE contacto DROP COLUMN fecha_envio");
    }
}
