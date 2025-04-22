# API Converter

Une api rest de conversion de fichier d'une extension à une autre.

> [!NOTE]
> c'est une première version très basic, elle a pour objectif de ce complexifier


# Route

> /converter
> > Permet de convertir un fichier csv en txt ou xlsx
> >
> > Query

> [!WARN]
> Prend en compte uniquement le format txt et xlsx en sortie

| nom attribut |  type  |        description        |
|:------------:|:------:|:-------------------------:|
|     file     |  file  |   file csv à convertir    |
|    target_format    | string | la cible de la convertion |

