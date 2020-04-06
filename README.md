## TP1

# Quel est l'intérêt de créer une API plutôt qu'une application classique ?

Une API permet dans un premier temps de ne pas avoir à refaire du code si l'on décide d'avoir une application disponible sur mobile et ordinateur ce qui est un problème majeur aujourd'hui. Elle permet aussi une meilleur distinction entre le front end et le back end de l'application

# Résumez les étapes du mécanisme de sérialisation implémenté dans Symfony

Dans symfony, afin d'être sérialisé, un objet est d'abord normalisé (transformé en tableau) et ce tableau est ensuite encoder au format désiré (souvent JSON).
L'objet Serializer de symfony prend donc 2 paramètres, l'objet a serialisé et le format désiré

# Qu'est-ce qu'un groupe de sérialisation ? A quoi sert-il ?

un groupe de serialisation est une annotation dans une entité permettant de n'afficher dans la réponse de notre API que les attributs de l'entité que l'on a définit dans le groupe. Cela permet donc de montrer à l'utilisateur que ce qu'il a besoin de voir et par exemple avoir d'autres attributs accessibles que par un administrateur ou une personne ayant accès à la BDD

# Quelle est la différence entre la méthode PUT et la méthode PATCH ?

La méthode PUT modifie tous les champs de l'entité (la requete doit donc spécifier tous ces champs) tandis que la méthode PATCH ne modifie que les champs que la requete aura spécifié

# Quels sont les différents types de relation entre entités pouvant être mis en place avec Doctrine ?

il existe 3 types de relations dans doctrine : ManyToOne, OneToOne et OneToMany
Comme leur nom l'indique, OneToOne est une relation 1 entité pour 1 autre, OneToMany signifie qu'une entité peut etre liée à plusieurs autres, ManyToOne est juste l'inverse de OneToMany

# Qu'est-ce qu'un Trait en PHP et à quoi peut-il servir ?

un trait est similaire à une classe mais ne peut pas être implémenter. Un trait fonctionne comme de l'héritage donc permet de réutiliser du code mais sans la contrainte de l'héritage puisque en php une classe ne peut hériter que d'une seule classe tandis qu'elle peut avoir plusieurs traits.