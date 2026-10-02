      Passo a Passo do Fluxo de Trabalho (Clonar ao Merge)

           Clonar o Repositório

Para clonar o projeto para a tua máquina:
 
git clone <URLdorepositorio>

            Criar uma Nova Branch
Nunca trabalhes diretamente na `main`. Cria uma branch seguindo o Padrão de Branches:

git checkout -b tipo/issue-NN-descricao-curta

                      Fazer Commit
Após fazer as alterações nos arquivos, faça o commit:

git add .
git commit -m "tipo/descricao-curta"
