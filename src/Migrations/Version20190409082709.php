<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190409082709 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE notes ADD matiere_id_id INT NOT NULL, ADD user_id_id INT NOT NULL, DROP matiere_id, DROP user_id');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68CF3E43022 FOREIGN KEY (matiere_id_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE notes ADD CONSTRAINT FK_11BA68C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_11BA68CF3E43022 ON notes (matiere_id_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_11BA68C9D86650F ON notes (user_id_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68CF3E43022');
        $this->addSql('ALTER TABLE notes DROP FOREIGN KEY FK_11BA68C9D86650F');
        $this->addSql('DROP INDEX UNIQ_11BA68CF3E43022 ON notes');
        $this->addSql('DROP INDEX UNIQ_11BA68C9D86650F ON notes');
        $this->addSql('ALTER TABLE notes ADD matiere_id INT NOT NULL, ADD user_id INT NOT NULL, DROP matiere_id_id, DROP user_id_id');
    }
}
