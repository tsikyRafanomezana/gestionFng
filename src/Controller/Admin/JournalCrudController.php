<?php

namespace App\Controller\Admin;

use App\Entity\Journal;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Filter\DateTimeFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\EntityFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use App\Entity\Motif;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class JournalCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Journal::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Journal')
            ->overrideTemplate('crud/index', 'admin/journal/index.html.twig');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
           // IdField::new('id'),
            DateField::new('dateJournal'),
            AssociationField::new('libelle', 'Motif'),
            ChoiceField::new('typeJournal')
            ->setChoices([
                'Niditra' => '0',
                'Nivoaka' => '1',
                'Niditra/Nivoaka' => '2'
            ]),
            MoneyField::new('montant', 'Montant')->setCurrency('MGA'),
            TextEditorField::new('commentaire','Commentaire'),
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(DateTimeFilter::new('dateJournal')) 
            ->add(EntityFilter::new('libelle'))
            ->add(ChoiceFilter::new('typeJournal')       
            ->setChoices([
                'Niditra' => '0',
                'Nivoaka' => '1',
                'Niditra/Nivoaka' => '2',
            ])
        );
    }
    
}
