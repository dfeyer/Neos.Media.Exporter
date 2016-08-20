# Import / Export CLI command for Neos Media

This package export all assets, tags and asset collections to YAML files. One file per entity
to keep it simple.

## Export

    flow media:export --directory ./Exports
    
You should see something like this in the Exports directory::

    Export
    Export/2016-08-20-161724
    Export/2016-08-20-161724/AssetCollections
    Export/2016-08-20-161724/AssetCollections/0aadbdcd-082c-43b7-be00-8dec70d35018.yaml
    Export/2016-08-20-161724/AssetCollections/29e3928f-398a-4d5b-acfc-492c811ee556.yaml
    Export/2016-08-20-161724/AssetCollections/ca0c767a-44f9-49ee-bb5a-9ee067af858b.yaml
    Export/2016-08-20-161724/Assets
    Export/2016-08-20-161724/Assets/TYPO3
    Export/2016-08-20-161724/Assets/TYPO3/Media
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Document
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Document/01bd7db4-701d-ee94-c8e6-4521fa71128e.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/08aaeb84-dccc-6af4-0086-93499de4e1bc.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/0bf33a79-3ee6-cdb2-94f1-95bc46beee0b.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/10b114c2-7fc3-6e3a-ab8f-0a85a0854143.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/11d3aded-fb1a-70e7-1412-0b465b11fcd8.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/17602a91-ba2b-c40d-e9fe-10f92ea6bd8b.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/65e3383c-173c-2f2e-1afc-259ba2bd3ca6.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/6aac7ce2-b2e1-4e20-6987-42daa4edfbd2.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/6bc60415-af45-b2f4-af11-73b32e4532e9.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/8058d91b-10d9-4813-b894-df8200c4d546.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/8244a1f2-5474-c7c2-0bcb-2c1f53080103.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/a0178d77-5c04-b829-a613-c9d2b6fb92cb.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/a126280f-2a8e-0592-0e14-cc2cd9808bb2.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/a798ee5d-e75b-3595-578e-056439e1695e.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/b674d9cd-4a7f-a33a-be12-9a5efdaedb98.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/cd3e00c5-fee4-4a65-af30-4a0f98a1c040.yaml
    Export/2016-08-20-161724/Assets/TYPO3/Media/Domain/Model/Image/d08de093-dc6b-55ea-adfc-d894ef87b0e0.yaml
    Export/2016-08-20-161724/Tags
    Export/2016-08-20-161724/Tags/00d5a227-a112-4692-b8df-10aa2880d0d6.yaml
    Export/2016-08-20-161724/Tags/0f7649cb-9fe3-4abe-86cc-a55b57703fa9.yaml
    Export/2016-08-20-161724/Tags/2ee4cd2d-8024-4d76-aa50-7ca70676b17c.yaml
    Export/2016-08-20-161724/Tags/5c378fee-9dc5-4e7b-b4ae-18dd5d811e2a.yaml
    Export/2016-08-20-161724/Tags/b453d499-651e-4353-b3ef-c13f93c33e41.yaml
    Export/2016-08-20-161724/Tags/bf187dd7-1143-4034-bb08-65e08a24ba3c.yaml
    Export/2016-08-20-161724/Tags/cf43c614-99f7-4544-af10-8638897f4b9a.yaml

The package is based on official type converter, those converter need to be improved in order to have a
complete backup solution.

## Import

Not working currently
