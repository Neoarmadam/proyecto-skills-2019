<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221205631 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE juegos (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(45) NOT NULL, descripcion VARCHAR(125) DEFAULT NULL, votos_positivos INT DEFAULT NULL, votos_negativos INT DEFAULT NULL, imagen LONGBLOB DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE juegos_genero (juegos_id INT NOT NULL, genero_id INT NOT NULL, INDEX IDX_F0D341ACFC632F0C (juegos_id), INDEX IDX_F0D341ACBCE7B795 (genero_id), PRIMARY KEY(juegos_id, genero_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE juegos_genero ADD CONSTRAINT FK_F0D341ACFC632F0C FOREIGN KEY (juegos_id) REFERENCES juegos (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE juegos_genero ADD CONSTRAINT FK_F0D341ACBCE7B795 FOREIGN KEY (genero_id) REFERENCES genero (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE juegos_genero DROP FOREIGN KEY FK_F0D341ACFC632F0C');
        $this->addSql('ALTER TABLE juegos_genero DROP FOREIGN KEY FK_F0D341ACBCE7B795');
        $this->addSql('DROP TABLE juegos');
        $this->addSql('DROP TABLE juegos_genero');
    }
}
